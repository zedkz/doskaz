<?php
declare(strict_types=1);

namespace App\Blog;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
final class Meta
{
    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    private $title;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    private $tags;

    public function __construct(?string $title, ?string $description, ?string $tags)
    {
        $this->title = $title;
        $this->description = $description;
        $this->tags = $tags;
    }
}