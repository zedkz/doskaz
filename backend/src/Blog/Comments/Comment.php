<?php


namespace App\Blog\Comments;

use App\Infrastructure\DomainEvents\EventProducer;
use App\Infrastructure\DomainEvents\ProducesEvents;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="blog_comments")
 */
class Comment implements EventProducer
{
    use ProducesEvents;

    /**
     * @var UuidInterface
     * @ORM\Column(type="uuid")
     * @ORM\Id()
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $postId;

    /**
     * @var UuidInterface
     * @ORM\Column(type="uuid", nullable=true)
     */
    private $parentId;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @var integer
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    private $popularity = 0;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $createdAt;

    public function increasePopularity()
    {
        $this->popularity++;
    }

    public function __construct(int $postId, int $userId, string $text, ?UuidInterface $parentId = null)
    {
        $this->id = Uuid::uuid4();
        $this->postId = $postId;
        $this->userId = $userId;
        $this->text = $text;
        $this->parentId = $parentId;
        $this->createdAt = new \DateTimeImmutable();
        $this->remember(new CommentCreated($this->id, $this->userId));
    }
}
