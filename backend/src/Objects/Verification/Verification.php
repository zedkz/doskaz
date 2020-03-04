<?php


namespace App\Objects\Verification;


use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="object_verifications")
 */
class Verification
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     */
    private $id;

    /**
     * @ORM\Column(type="datetimetz_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $userId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verified;

    /**
     * Verification constructor.
     * @param $id
     */
    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
        $this->verified = false;
    }

    public function confirm(int $userId)
    {
        $this->verified = true;
        $this->userId = $userId;
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function reject(int $userId)
    {
        $this->verified = false;
        $this->userId = $userId;
        $this->updatedAt = new \DateTimeImmutable();
    }


}