<?php
declare(strict_types=1);

namespace App\Complaints;

use Goodwix\DoctrineJsonOdm\Annotation\ODM;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM()
 * @DiscriminatorMap(typeProperty="type", mapping={
 *     "complaint1" = "App\Complaints\ComplaintType1",
 *     "complaint2" = "App\Complaints\ComplaintType2",
 * })
 */
abstract class ComplaintContent
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $type;

    /**
     * @var \DateTimeImmutable
     * @Assert\NotBlank()
     */
    public $visitedAt;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $objectName;

    /**
     * @var string|int|null
     * @Assert\NotBlank()
     */
    public $cityId;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $street;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $building;

    /**
     * @var string|null
     */
    public $office;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $visitPurpose;

    /**
     * @var string[]
     */
    public $videos = [];

    /**
     * @var string[]
     */
    public $photos = [];

}