<?php


namespace App\Tasks\Administration;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class AdministrationTaskRepository
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(AdministrationTask::class);
    }

    public function add(AdministrationTask $administrationTask)
    {
        $this->entityManager->persist($administrationTask);
    }
}