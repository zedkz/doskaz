<?php


namespace App\RegionalCoordinators;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="regional_coordinators")
 */
class RegionalCoordinator
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private int $userId;

    /**
     * @ORM\Column(type=App\RegionalCoordinators\CityIdCollection::class, options={"jsonb" = true})
     */
    private CityIdCollection $cities;

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
    private \DateTimeImmutable $deletedAt;

    public function __construct(int $userId, CityIdCollection $cities)
    {
        $this->userId = $userId;
        $this->cities = $cities;
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }
}