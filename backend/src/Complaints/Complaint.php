<?php
declare(strict_types=1);

namespace App\Complaints;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="complaints")
 */
class Complaint
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var Complainant
     * @ORM\Column(type=Complainant::class, options={"jsonb" = true})
     */
    private $complainant;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $authorityId;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $createdAt;

    private $data;
}