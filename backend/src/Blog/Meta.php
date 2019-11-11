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
    private $keywords;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    private $ogTitle;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     */
    private $ogDescription;

    public function __construct(?string $title = null, ?string $description = null, ?string $keywords = null, ?string $ogTitle = null, ?string $ogDescription = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->ogTitle = $ogTitle;
        $this->ogDescription = $ogDescription;
    }

    public static function fromMetaData(?MetaData $data): self
    {
        if ($data) {
            return new self(
                $data->title,
                $data->description,
                $data->keywords,
                $data->ogTitle,
                $data->ogDescription
            );
        }
        return new self();
    }
}