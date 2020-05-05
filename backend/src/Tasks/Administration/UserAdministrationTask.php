<?php


namespace App\Tasks\Administration;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user_administration_tasks")
 */
class UserAdministrationTask
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $userId;

    /**
     * @ORM\Column(type="uuid")
     */
    private UuidInterface $taskId;

    /**
     * @ORM\Column(type="integer")
     */
    private int $points;

    /**
     * @ORM\Column(type="datetimetz_immutable")
     */
    private \DateTimeImmutable $createdAt;

    public function __construct(int $userId, UuidInterface $taskId, int $points)
    {
        $this->id = Uuid::uuid4();
        $this->userId = $userId;
        $this->taskId = $taskId;
        $this->points = $points;
        $this->createdAt = new \DateTimeImmutable();
    }
}