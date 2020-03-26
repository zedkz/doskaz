<?php


namespace App\Users\Security;


use App\Infrastructure\Doctrine\Flusher;
use App\Users\FullName;
use App\Users\Security\Oauth\OauthCredentials;
use App\Users\Security\Oauth\OauthCredentialsRepository;
use App\Users\User;
use App\Users\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UloginAuthenticate extends AbstractController
{
    /**
     * @Route(path="/api/token/ulogin")
     * @param Request $request
     * @param OauthCredentialsRepository $credentialsRepository
     * @param UserRepository $userRepository
     * @param UserAuthenticator $authenticator
     * @param Flusher $flusher
     * @return Response
     * @throws \Exception
     */
    function token(Request $request, OauthCredentialsRepository $credentialsRepository, UserRepository $userRepository, UserAuthenticator $authenticator, Flusher $flusher)
    {
        $token = json_decode($request->getContent(), true)['token'];
        $profile = json_decode(file_get_contents('http://ulogin.ru/token.php?token=' . $token . '&host=' . $request->getHost()), true);

        $network = $profile['network'];
        $id = $profile['uid'];

        $credentials = $credentialsRepository->findByNetworkAndIdentifier($network, $id);

        if ($credentials) {
            $user = $userRepository->find($credentials->id());
            return $authenticator->authenticate($request, $user);
        }

        $user = new User(new FullName($profile['first_name'], $profile['last_name']), null);
        $userRepository->add($user);
        $credentials = new OauthCredentials($user->id(), $network, $id);
        $credentialsRepository->add($credentials);
        $flusher->flush();
        return $authenticator->authenticate($request, $user)->setStatusCode(Response::HTTP_CREATED);
    }
}