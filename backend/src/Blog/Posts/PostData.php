<?php
declare(strict_types=1);

namespace App\Blog\Posts;


use App\Infrastructure\ObjectResolver\DataObject;
use Symfony\Component\Validator\Constraints as Assert;

final class PostData implements DataObject
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $title;

    /**
     * @var string|null
     */
    public $slug;

    /**
     * @var \DateTimeImmutable
     * @Assert\NotBlank()
     */
    public $publishedAt;

    /**
     * @var boolean
     */
    public $isPublished;

    /**
     * @var integer
     * @Assert\NotBlank()
     */
    public $categoryId;
}