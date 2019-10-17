<?php


namespace App\Users;


use Doctrine\ORM\EntityManagerInterface;

final class UserRepository
{
    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
    }

    public function add(User $user): void
    {
        $this->entityManager->persist($user);
    }

    public function find($id): ?User
    {
        return $this->repository->find($id);
    }
}