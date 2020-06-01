<?php


namespace App\UserEvents\ObjectReviewed;

use App\Infrastructure\Doctrine\Flusher;
use App\Infrastructure\DomainEvents\EventListener;
use App\Objects\MapObjectRepository;
use App\Objects\Reviews\Event\ReviewCreated;
use App\UserEvents\UserEvent;
use App\UserEvents\UserEventRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RememberWhenObjectReviewed implements EventListener
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    /**
     * @var Flusher
     */
    private $flusher;
    /**
     * @var UserEventRepository
     */
    private $repository;
    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var MapObjectRepository
     */
    private $mapObjectRepository;

    public function __construct(Flusher $flusher, UserEventRepository $repository, Connection $connection, MapObjectRepository $mapObjectRepository)
    {
        $this->flusher = $flusher;
        $this->repository = $repository;
        $this->connection = $connection;
        $this->mapObjectRepository = $mapObjectRepository;
    }

    /**
     * @param ReviewCreated $event
     * @throws \Exception
     */
    public function handle($event)
    {
        $object = $this->mapObjectRepository->find($event->objectId);
        if ($object->createdBy() && $object->createdBy() !== $event->userId) {
            $this->repository->add(new UserEvent($object->createdBy(), new ObjectReviewedData($event->userId, $object->uuid())));
            $this->flusher->flush();
        }
    }

    public function supports($event): bool
    {
        return $event instanceof ReviewCreated;
    }
}
