<?php
declare(strict_types=1);

namespace App\Objects;


use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Ramsey\Uuid\UuidInterface;

final class MapObjectRepository
{
    private $entityManager;

    /**
     * @var $repository EntityRepository
     */
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

    public function findByUuid(UuidInterface $uuid): ?MapObject
    {
        return $this->repository->findOneBy([
            'uuid' => $uuid
        ]);
    }

    public function forAggregate(int $id, callable $callback)
    {
        $this->entityManager->transactional(function () use ($id, $callback) {
            $mapObject = $this->repository->find($id, LockMode::PESSIMISTIC_WRITE);
            $callback($mapObject);
            $this->entityManager->flush();
        });
    }
}