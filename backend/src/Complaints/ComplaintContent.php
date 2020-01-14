<?php
declare(strict_types=1);

namespace App\Complaints;

use Goodwix\DoctrineJsonOdm\Annotation\ODM;
use OpenApi\Annotations\Discriminator;
use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM()
 * @DiscriminatorMap(typeProperty="type", mapping={
 *     "complaint1"="App\Complaints\ComplaintType1",
 *     "complaint2"="App\Complaints\ComplaintType2",
 * })
 * @Schema(
 *     title="Содержимое жалобы",
 *     schema="AbstractComplaintContent",
 *     oneOf={
 *         @Schema(ref="#/components/schemas/ComplaintContent1"),
 *         @Schema(ref="#/components/schemas/ComplaintContent2")
 *     },
 *     discriminator={
 *         @Discriminator(
 *             propertyName="type",
 *             mapping={
 *                 "complaint1"="#/components/schemas/ComplaintContent1",
 *                 "complaint2"="#/components/schemas/ComplaintContent2"
 *             }
 *         )
 *     }
 * )
 */
class ComplaintContent
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Property(example="complaint1")
     */
    public $type;

    /**
     * @var \DateTimeImmutable
     * @Assert\NotBlank()
     * @Property()
     */
    public $visitedAt;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Property(nullable=false, description="Наименование объекта")
     */
    public $objectName;

    /**
     * @var string|int
     * @Assert\NotBlank()
     * @Property(nullable=false, description="Id города")
     */
    public $cityId;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Property(nullable=false, description="Улица")
     */
    public $street;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Property(nullable=false, description="Номер дома")
     */
    public $building;

    /**
     * @var string|null
     * @Property(description="Номер офиса")
     */
    public $office;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Property(nullable=false, description="Цель посещения")
     */
    public $visitPurpose;

    /**
     * @var string[]
     * @Property()
     */
    public $videos = [];

    /**
     * @var string[]
     * @Property()
     */
    public $photos = [];

}