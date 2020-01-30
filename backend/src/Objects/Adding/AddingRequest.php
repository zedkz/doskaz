<?php


namespace App\Objects\Adding;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="adding_requests")
 */
class AddingRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var integer|null
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $userId;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $createdAt;
}