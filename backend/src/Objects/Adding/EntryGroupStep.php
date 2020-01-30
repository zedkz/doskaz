<?php


namespace App\Objects\Adding;


use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;

/**
 * @Schema(title="Входная группа", schema="EnterGroup")
 */
class EntryGroupStep
{
    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Вход на уровне земли")
     */
    public $hasGroundLevelEntrance = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Лестница наружная - Предупреждающая полоса")
     */
    public $hasWarningStrip = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Ширина проступей лестниц не менее 40 см")
     */
    public $hasRequiredStairsThreadWidth = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Высота подъема ступеней не более 12 см")
     */
    public $hasRequiredStepsHeight = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Количество ступеней")
     */
    public $hasRequiredStepsCount = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Ширина марша лестниц не менее 1,35 м")
     */
    public $hasRequiredStairsMarchWidth = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Поручни перил при перепадах высот более 0,45 м - Вдоль обеих сторон")
     */
    public $hasHandrailsOnBothSides = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Поручни перил при перепадах высот более 0,45 м - На высоте 0,9 м для взрослых, 0,5 м для детей")
     */
    public $hasHandrailsRequiredHeight = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Поручни перил при перепадах высот более 0,45 м - Горизонтальный закругленный вылет после последней опоры 30 см")
     */
    public $hasHorizontalRoundedOutreach = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Поручни перил при перепадах высот более 0,45 м - При ширине лестничного марша более 2,5 м — разделительные поручни")
     */
    public $hasDividingHandrails = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Покрытие пандуса - Твёрдые материалы")
     */
    public $hasRampHardCoating = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Покрытие пандуса - Без зазоров")
     */
    public $hasRampCoatingWithoutGaps = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Покрытие пандуса - Без вибрации при движении")
     */
    public $hasRampCoatingWithoutVibration = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Покрытие пандуса - Предотвращающее скольжение")
     */
    public $hasRampCoatingSkidResistant = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Ширина марша не менее 1,2 м")
     */
    public $hasRampMarchRequiredMinimalWidth = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Разворотные горизонтальные площадки")
     */
    public $hasRampTurntable = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Высота марша 40-45 см")
     */
    public $hasRampRequiredMarchHeight = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Уклон")
     */
    public $hasRampRequiredSkew = ZoneAttribute::UNKNOWN;

    /**
     * @var string
     * @Assert\Choice(choices=Zone::ATTRIBUTES)
     * @Property(enum=App\Objects\Adding\ZoneAttribute::ATTRIBUTES, description="Бортики не менее 5 см")
     */
    public $hasRampRequiredBordersHeight = ZoneAttribute::UNKNOWN;


}