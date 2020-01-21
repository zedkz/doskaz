<?php


namespace App\Objects;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="objects")
 */
class MapObject
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $categoryId;

    /**
     * @ORM\Embedded(class="App\Objects\Point")
     */
    private $point;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $title;

    public function __construct(Point $point, string $title, ?int $categoryId)
    {
        $this->point = $point;
        $this->categoryId = $categoryId;
        $this->title = $title;
    }
}