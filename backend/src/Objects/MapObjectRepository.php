<?php
declare(strict_types=1);

namespace App\Objects;


use Doctrine\ORM\EntityManagerInterface;

final class MapObjectRepository
{
    private $entityManager;

    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(MapObject::class);
    }

    public function add(MapObject $mapObject)
    {
        $this->entityManager->persist($mapObject);
    }
}