<?php


namespace App\Objects;

use App\Objects\Adding\AccessibilityScore;
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

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var Zones
     * @ORM\Column(type=Zones::class, nullable=true, options={"jsonb" = true}, nullable=true)
     */
    private $zones;

    /**
     * @var AccessibilityScore
     * @ORM\Embedded(class=AccessibilityScore::class)
     */
    private $overallScore;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetimetz_immutable", nullable=true)
     */
    private $createdAt;

    public function __construct(
        Point $point,
        string $title,
        ?int $categoryId,
        Zones $zones,
        string $address,
        string $description
    )
    {
        $this->point = $point;
        $this->categoryId = $categoryId;
        $this->title = $title;
        $this->zones = $zones;
        $this->address = $address;
        $this->description = $description;
        $this->overallScore = $zones->overallScore();
        $this->createdAt = new \DateTimeImmutable();
    }
}