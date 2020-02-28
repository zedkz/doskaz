<?php


namespace App\Objects;

use App\Infrastructure\DomainEvents\EventProducer;
use App\Infrastructure\DomainEvents\ProducesEvents;
use App\Infrastructure\FileReferenceCollection;
use App\Objects\Adding\AccessibilityScore;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="objects")
 */
class MapObject implements EventProducer
{
    use ProducesEvents;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Column(type="uuid", unique=true, nullable=true)
     */
    private $uuid;

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

    /**
     * @var integer|null
     * @ORM\Column(type="integer", nullable=true, unique=true)
     */
    private $requestId;

    /**
     * @var string[]
     * @ORM\Column(type="json", options={"jsonb" = true, "default" = "[]"}, nullable=false)
     */
    private $videos;

    /**
     * @var FileReferenceCollection
     * @ORM\Column(type=App\Infrastructure\FileReferenceCollection::class, options={"jsonb" = true})
     */
    private $photos;

    /**
     * @var \DateTimeImmutable|null
     * @ORM\Column(type="datetimetz_immutable", nullable=true)
     */
    private $deletedAt;

    /**
     * @var \DateTimeImmutable|null
     * @ORM\Column(type="datetimetz_immutable", nullable=true)
     */
    private $updatedAt;

    public function __construct(
        Point $point,
        string $title,
        ?int $categoryId,
        Zones $zones,
        string $address,
        string $description,
        FileReferenceCollection $photos,
        array $videos
    )
    {
        $this->uuid = Uuid::uuid4();
        $this->point = $point;
        $this->categoryId = $categoryId;
        $this->title = $title;
        $this->zones = $zones;
        $this->address = $address;
        $this->description = $description;
        $this->overallScore = $zones->overallScore();
        $this->updatedAt = $this->createdAt = new \DateTimeImmutable();
        $this->videos = $videos;
        $this->photos = $photos;
        if (!$this->photos->isEmpty()) {
            $this->remember(new PhotosUpdated($this->uuid, $this->photos, $photos));
        }
    }

    public static function createFromRequest(
        int $requestId,
        Point $point,
        string $title,
        ?int $categoryId,
        Zones $zones,
        string $address,
        string $description,
        FileReferenceCollection $photos,
        array $videos
    ): self
    {
        $self = new self($point, $title, $categoryId, $zones, $address, $description, $photos, $videos);
        $self->requestId = $requestId;
        return $self;
    }

    public function markAsDeleted()
    {
        $this->deletedAt = new \DateTimeImmutable();
    }

    public function idDeleted(): bool
    {
        return !is_null($this->deletedAt);
    }

    public function toMapObjectData(): MapObjectData
    {
        return new MapObjectData(
            $this->id,
            $this->title,
            $this->address,
            $this->description,
            $this->categoryId,
            $this->point->toLatLong(),
            $this->videos,
            $this->photos,
            $this->zones
        );
    }

    public function update(MapObjectData $mapObjectData)
    {
        Assert::null($this->deletedAt, 'Update a deleted object is not allowed!');
        $this->remember(new PhotosUpdated($this->uuid, $this->photos, $mapObjectData->photos));
        $this->title = $mapObjectData->title;
        $this->address = $mapObjectData->address;
        $this->description = $mapObjectData->description;
        $this->categoryId = $mapObjectData->categoryId;
        $this->point = Point::fromLatLong($mapObjectData->point[0], $mapObjectData->point[1]);
        $this->videos = $mapObjectData->videos;
        $this->photos = $mapObjectData->photos;
        $this->zones = $mapObjectData->zones;
        $this->overallScore = $this->zones->overallScore();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function id()
    {
        return $this->id;
    }
}