<?php


namespace App\Users\Security\Oauth;


use App\Infrastructure\Doctrine\Flusher;
use App\Users\Security\UserAuthenticator;
use App\Users\User;
use App\Users\UserRepository;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ServiceLocator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


final class OauthController extends AbstractController
{
    private $oauthProviderLocator;

    public function __construct(ServiceLocator $oauthProviderLocator)
    {
        $this->oauthProviderLocator = $oauthProviderLocator;
    }

    /**
     * @Route(path="/oauth/{providerKey}/redirect", methods={"GET"})
     * @param string $providerKey
     * @return RedirectResponse
     */
    public function oauthRedirect(string $providerKey)
    {
        if (!$this->oauthProviderLocator->has($providerKey)) {
            throw new NotFoundHttpException(sprintf('Provider %s not found', $providerKey));
        }
        return new RedirectResponse($this->oauthProviderLocator->get($providerKey)->getAuthorizationUrl());
    }

    /**
     * @Route(path="/api/token/oauth/{providerKey}", methods={"POST"})
     * @param Request $request
     * @param string $providerKey
     * @param OauthData $oauthData
     * @param OauthCredentialsRepository $credentialsRepository
     * @param UserRepository $userRepository
     * @param Flusher $flusher
     * @param UserAuthenticator $authenticator
     * @return Response
     * @throws \Exception
     */
    public function oauthAuthenticate(Request $request, string $providerKey, OauthData $oauthData, OauthCredentialsRepository $credentialsRepository, UserRepository $userRepository, Flusher $flusher, UserAuthenticator $authenticator)
    {
        if (!$this->oauthProviderLocator->has($providerKey)) {
            throw new NotFoundHttpException(sprintf('Provider %s not found', $providerKey));
        }

        /**
         * @var AbstractProvider $provider
         */
        $provider = $this->oauthProviderLocator->get($providerKey);
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $oauthData->code
        ]);

        /**
         * @var ResourceOwnerInterface $resourceOwner
         */
        $resourceOwner = $provider->getResourceOwner($accessToken);

        $credentials = $credentialsRepository->findByNetworkAndIdentifier('google', (string)$resourceOwner->getId());
        if ($credentials) {
            $user = $userRepository->find($credentials->id());
            return $authenticator->authenticate($request, $user);
        }

        $user = new User($resourceOwner->getName(), $resourceOwner->getEmail());
        $userRepository->add($user);

        $credentials = new OauthCredentials($user->id(), 'google', (string)$resourceOwner->getId());
        $credentialsRepository->add($credentials);

        $flusher->flush();

        return $authenticator->authenticate($request, $user);
    }
}