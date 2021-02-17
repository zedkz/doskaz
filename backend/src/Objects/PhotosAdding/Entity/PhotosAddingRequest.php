<?php


namespace App\Objects\PhotosAdding\Entity;

use App\Infrastructure\DomainEvents\EventProducer;
use App\Infrastructure\DomainEvents\ProducesEvents;
use App\Infrastructure\FileReferenceCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="object_photos_adding_requests")
 */
class PhotosAddingRequest implements EventProducer
{
    use ProducesEvents;

    private const STATUS_ON_REVIEW = 'on_review';

    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $objectId;

    /**
     * @ORM\Column(type="integer")
     */
    private int $createdBy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $approvedBy;

    /**
     * @ORM\Column(type="datetimetz_immutable")
     */
    private \DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetimetz_immutable", nullable=true)
     */
    private ?\DateTimeImmutable $approvedAt;

    /**
     * @ORM\Column(type="string")
     */
    private string $status;

    /**
     * @var FileReferenceCollection
     * @ORM\Column(type=App\Infrastructure\FileReferenceCollection::class, options={"jsonb" = true})
     */
    private FileReferenceCollection $photos;

    public function __construct(int $objectId, int $createdBy, FileReferenceCollection $photos)
    {
        $this->id = Uuid::uuid6();
        $this->objectId = $objectId;
        $this->createdBy = $createdBy;
        $this->createdAt = new \DateTimeImmutable();
        $this->status = self::STATUS_ON_REVIEW;
        $this->photos = $photos;
    }
}