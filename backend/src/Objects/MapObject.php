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

    public function __construct(Point $point, ?int $categoryId)
    {
        $this->point = $point;
        $this->categoryId = $categoryId;
    }
}