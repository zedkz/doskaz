<?php


namespace App\Blog\Comments;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="blog_comments")
 */
class Comment
{
    /**
     * @var int
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @ORM\Id()
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $postId;

    /**
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
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

    public function __construct(int $postId, int $userId, string $text, ?int $parentId = null)
    {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->text = $text;
        $this->parentId = $parentId;
        $this->createdAt = new \DateTimeImmutable();
    }
}
