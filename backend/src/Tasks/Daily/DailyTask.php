<?php


namespace App\Tasks\Daily;

use App\Infrastructure\DomainEvents\EventProducer;
use App\Infrastructure\DomainEvents\ProducesEvents;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Webmozart\Assert\Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="daily_tasks")
 */
class DailyTask implements EventProducer
{
    use ProducesEvents;

    /**
     * @var UuidInterface
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @var \DateTimeImmutable|null
     * @ORM\Column(type="datetimetz_immutable", nullable=true)
     */
    private $completedAt;

    /**
     * @var UuidInterface|null
     * @ORM\Column(type="uuid", nullable=true)
     */
    private $addedObjectId;

    /**
     * @var UuidInterface|null
     * @ORM\Column(type="uuid", nullable=true)
     */
    private $verifiedObjectId;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $progress;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $createdAt;

    public function __construct(int $userId)
    {
        $this->id = Uuid::uuid4();
        $this->userId = $userId;
        $this->progress = 0;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function reset()
    {
        Assert::null($this->completedAt, 'Cannot reset completed task');
        $this->addedObjectId = null;
        $this->verifiedObjectId = null;
        $this->progress = 0;
    }

    public function objectAdded(UuidInterface $objectId)
    {
        Assert::null($this->completedAt, 'Cannot progress completed task');
        $this->addedObjectId = $objectId;
        $this->checkForCompletion();
    }

    public function objectVerified(UuidInterface $objectId)
    {
        Assert::null($this->completedAt, 'Cannot progress completed task');
        $this->verifiedObjectId = $objectId;
        $this->checkForCompletion();
    }

    private function checkForCompletion()
    {
        $this->progress = 0;

        if ($this->addedObjectId) {
            $this->progress += 50;
        }
        if ($this->verifiedObjectId) {
            $this->progress += 50;
        }

        if ($this->progress === 100) {
            $this->completedAt = new \DateTimeImmutable();
            $this->remember(new DailyTaskDone($this->id));
        }
    }

    public function makeNextTask(): self
    {
        Assert::notNull($this->completedAt);
        return new self($this->userId);
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }
}