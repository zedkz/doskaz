<?php


namespace App\Blog\Posts;

use App\Blog\Meta;
use App\Blog\Slug;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="blog_posts")
 * @ORM\Entity()
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @var Slug
     * @ORM\Embedded(class="\App\Blog\Slug")
     */
    private $slug;

    /**
     * @ORM\Column(type="integer")
     */
    private $categoryId;

    /**
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isPublished = true;

    /**
     * @var Meta
     * @ORM\Embedded(class="\App\Blog\Meta")
     */
    private $meta;

    public function __construct(PostData $postData, Meta $meta, Slug $slug)
    {
        $this->title = $postData->title;
        $this->categoryId = $postData->categoryId;
        $this->publishedAt = $postData->publishedAt;
        $this->isPublished = $postData->isPublished;
        $this->meta = $meta;
        $this->slug = $slug;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }
}