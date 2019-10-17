<?php


namespace App\Users;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route(path="/api/users")
 * @IsGranted("ROLE_USER")
 */
final class UserController extends AbstractController
{
    /**
     * @Route(path="/me", methods={"GET", "POST"})
     * @param TokenStorageInterface $tokenStorage
     */
    public function me(TokenStorageInterface $tokenStorage)
    {
        dd($tokenStorage->getToken()->getUser());
    }
}