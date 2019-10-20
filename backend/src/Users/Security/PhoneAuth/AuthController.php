<?php


namespace App\Users\Security\PhoneAuth;


use App\Infrastructure\Doctrine\Flusher;
use App\Users\Security\UserAuthenticator;
use App\Users\User;
use App\Users\UserRepository;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AuthController
 * @package App\Users\Security\PhoneAuth
 * @Route(path="/api/token/phone")
 */
class AuthController extends AbstractController
{
    private $firebaseApiKey;

    public function __construct($firebaseApiKey)
    {
        $this->firebaseApiKey = $firebaseApiKey;
    }

    /**
     * @Route(methods={"POST"})
     * @param Request $request
     * @param PhoneAuthData $authData
     * @param CredentialsRepository $credentialsRepository
     * @param UserRepository $userRepository
     * @param Flusher $flusher
     * @param UserAuthenticator $authenticator
     * @return Response|null
     * @throws \Exception
     */
    public function index(Request $request, PhoneAuthData $authData, CredentialsRepository $credentialsRepository, UserRepository $userRepository, Flusher $flusher, UserAuthenticator $authenticator)
    {
        $client = new Client([
            'query' => [
                'key' => $this->firebaseApiKey
            ]
        ]);
        $data = null;

        $data = $client->post('https://www.googleapis.com/identitytoolkit/v3/relyingparty/getAccountInfo', [
            'json' => ['idToken' => $authData->idToken]
        ]);

        $userData = json_decode($data->getBody()->getContents(), true);
        $phoneNumber = $userData['users'][0]['phoneNumber'];
        if ($phoneNumber) {
            $phoneCredentials = $credentialsRepository->findByPhoneNumber($phoneNumber);
            if (!$phoneCredentials) {
                $user = new User('');
                $userRepository->add($user);
                $phoneCredentials = new Credentials($user->id(), $phoneNumber);
                $credentialsRepository->add($phoneCredentials);
                $flusher->flush();
            }
            $user = $userRepository->find($phoneCredentials->id());
            return $authenticator->authenticate($request, $user);
        }
        return null;
    }

}