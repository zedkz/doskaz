<?php


namespace App\Objects\Adding;


use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Schema(title="Парковка", schema="Parking")
 */
class ParkingStep
{
    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\Zone::ATTRIBUTES, description="Количество парковочных мест - Не менее одного на 25 мест")
     */
    public $hasPlaces = Zone::ATTRIBUTE_UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\Zone::ATTRIBUTES, description="Размер парковки - Не менее 3,66 х 5,38 м")
     */
    public $hasRequiredSize = Zone::ATTRIBUTE_UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\Zone::ATTRIBUTES, description="Знак на плоскости стоянки")
     */
    public $hasSignOnPlane = Zone::ATTRIBUTE_UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\Zone::ATTRIBUTES, description="Знак на вертикальной поверхности (стене, столбе, стойке)")
     */
    public $hasSignOnVerticalPlane = Zone::ATTRIBUTE_UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\Zone::ATTRIBUTES, description="Знак 5.15 «Место стоянки»")
     */
    public $hasPlaceSign = Zone::ATTRIBUTE_UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\Zone::ATTRIBUTES, description="Знак 7.15 «Инвалиды»")
     */
    public $hasInvalidSign = Zone::ATTRIBUTE_UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\Zone::ATTRIBUTES, description="Стрелка и расстояние")
     */
    public $hasArrowAndDistance = Zone::ATTRIBUTE_UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\Zone::ATTRIBUTES, description="Разметка на плоскости")
     */
    public $hasMarkingsOnPlane = Zone::ATTRIBUTE_UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\Zone::ATTRIBUTES, description="Съезд с тротуара на парковку - Рекомендуется ширина 1,5 м")
     */
    public $hasRecommendedWidth = Zone::ATTRIBUTE_UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\Zone::ATTRIBUTES, description="Расстояние до входа в здание - Для общественных зданий менее 50 м")
     */
    public $hasRequiredDistanceToBuildingEnter = Zone::ATTRIBUTE_UNKNOWN;

    /**
     * @var string|null
     * @Property(type="string", nullable=true, description="Комментарий к зоне парковки")
     */
    public $comment;
}
