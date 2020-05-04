<?php


namespace App\Tasks\Administration;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="administration_tasks")
 */
class AdministrationTask
{
    /**
     * @ORM\Column(type="uuid")
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(type="datetimetz_immutable")
     */
    private \DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetimetz_immutable")
     */
    private \DateTimeImmutable $updatedAt;

    /**
     * @ORM\Column(type="datetimetz_immutable", nullable=true)
     */
    private ?\DateTimeImmutable $closedAt;

    /**
     * @ORM\Column(type="integer")
     */
    private int $points;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $cityId;

    /**
     * @ORM\Column(type="geometry", options={"geometry_type" = "POLYGON", "srid" = 4326}, nullable=true)
     */
    private $area;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $categoryId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $subCategoryId;

    public function __construct(int $points)
    {
        $this->id = Uuid::uuid4();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->points = $points;
    }
}