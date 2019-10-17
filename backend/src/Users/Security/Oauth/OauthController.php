<?php


namespace App\Users\Security\Oauth;


use App\Infrastructure\Doctrine\Flusher;
use App\Users\Security\UserAuthenticator;
use App\Users\User;
use App\Users\UserRepository;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Google;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/oauth")
 */
final class OauthController extends AbstractController
{
    /**
     * @Route(path="/google", methods={"GET"})
     * @param Google $google
     * @return RedirectResponse
     */
    public function googleRedirect(Google $google)
    {
        return new RedirectResponse($google->getAuthorizationUrl());
    }

    /**
     * @Route(path="/google/{code}", methods={"POST"}, requirements={"code"=".+"})
     * @param Request $request
     * @param string $code
     * @param Google $provider
     * @param OauthCredentialsRepository $credentialsRepository
     * @param UserRepository $userRepository
     * @param Flusher $flusher
     * @param UserAuthenticator $authenticator
     * @return Response
     * @throws IdentityProviderException
     */
    public function googleAuthenticate(Request $request, string $code, Google $provider, OauthCredentialsRepository $credentialsRepository, UserRepository $userRepository, Flusher $flusher, UserAuthenticator $authenticator)
    {
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $code
        ]);

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