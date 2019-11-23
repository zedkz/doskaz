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
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $complainantId;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetimetz_immutable")
     */
    private $createdAt;

    /**
     * @var ComplaintContent
     * @ORM\Column(type=ComplaintContent::class, options={"jsonb" = true})
     */
    private $content;

    public function __construct(Complainant $complainant, ComplaintContent $complaintContent, $authorityId, $complainantId)
    {
        $this->complainant = $complainant;
        $this->content = $complaintContent;
        $this->authorityId = $authorityId;
        $this->complainantId = $complainantId;
        $this->createdAt = new \DateTimeImmutable();
    }
}