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
     * @ORM\Embedded(class="App\Objects\Point")
     */
    private $point;

    public function __construct(Point $point)
    {
        $this->point = $point;
    }
}