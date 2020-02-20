<?php


namespace App\Objects\Zone\Middle;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Entrance extends Zone
{
    /**
     * Вход на уровне земли
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute1;

    /**
     * Предупреждающая полоса
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute2;

    /**
     * Ширина проступей лестниц не менее 40 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute3;

    /**
     * Высота подъема ступеней не более 12 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute4;

    /**
     * Количество ступеней
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute5;

    /**
     * Ширина марша лестниц не менее 1,35 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute6;

    /**
     * Вдоль обеих сторон
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute7;

    /**
     * На высоте 0,9 м для взрослых, 0,5 м для детей
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute8;

    /**
     * Горизонтальный закругленный вылет после последней опоры 30 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute9;

    /**
     * При ширине лестничного марша более 2,5 м — разделительные поручни
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute10;

    /**
     * Твёрдые материалы
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute11;

    /**
     * Без зазоров
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute12;

    /**
     * Без вибрации при движении
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute13;

    /**
     * Предотвращающее скольжение
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute14;

    /**
     * Ширина марша не менее 1,2 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute15;

    /**
     * Разворотные горизонтальные площадки
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute16;

    /**
     * Высота марша 40-45 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute17;

    /**
     * Уклон
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute18;

    /**
     * Бортики не менее 5 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute19;

    /**
     * Вдоль обеих сторон
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute20;

    /**
     * На высоте 0,7-0,9 м для взрослых, 0,5 м для детей
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute21;

    /**
     * Горизонтальный закругленный вылет после последней опоры 30 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute22;

    /**
     * Параметры не менее 0,9 х 1,2 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute23;

    /**
     * Жёсткое ограждение со всех сторон
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute24;

    /**
     * Бортики
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute25;

    /**
     * Входная площадка с пандусом
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute26;

    /**
     * При открывании «от себя» — не менее 1,2 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute27;

    /**
     * При открывании «к себе» — не менее 1,5 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute28;

    /**
     * Открытие в противоположную сторону от пандуса
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute29;

    /**
     * Ширина в свету не менее 90 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute30;

    /**
     * Пороги не выше 1,4 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute31;

    /**
     * Наличие предупреждения для слабовидящих на стеклянной двери
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute32;

    /**
     * Прямоугольник 10 х 20 см²
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute33;

    /**
     * Цвет яркий (контрастный)
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute34;

    /**
     * На высоте не ниже 1,2 м и не выше 1,5 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute35;

    /**
     * 1,5-1,8 м (глубина) х 2 м (ширина)
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute36;

    /**
     * 2,3 м (глубина) х  1,5 м (ширина)
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute37;

    /**
     * Доступность, высота 85 см  – 1 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute38;

    /**
     * Навес от осадков
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute39;

    /**
     * Шрифт Брайля
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute40;

    public function __construct()
    {
        foreach ($properties = (new \ReflectionClass($this))->getProperties() as $property) {
            $property->setValue($this, Attribute::unknown());
        }
    }

    public function calculateScore(): AccessibilityScore
    {
        if ($this->isMatches([1], Attribute::yes())) {
            return AccessibilityScore::fullAccessible();
        }

        $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;

        if ($this->isMatchesAll(Attribute::unknown())) {
            return AccessibilityScore::notAccessible();
        }

        if ($this->isMatchesAll(Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }

        if ($this->isMatchesAllExcept([1], Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $vision = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        if ($this->isMatches([2, 3, 4, 5, 6, 7, 8, 9], Attribute::yes())) {
            $hearing = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        } else if ($this->isMatches([7], Attribute::no())) {
            $hearing = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        } else if ($this->isMatchesPartial([2, 3, 4, 5, 6, 7, 8, 9], Attribute::yes())) {
            $hearing = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        }

        if ($this->isMatches([7, 11, 12, 13, 14, 18, 20, 23, 24, 25, 27, 28, 31, 33, 34, 38, 40], Attribute::no())) {
            $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        } else if ($this->isMatchesPartial([7, 11, 12, 13, 14, 18, 20, 23, 24, 25, 27, 28, 31, 33, 34, 38, 40], Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        }

        if ($this->isMatches([7, 33, 34, 39, 40], Attribute::no())) {
            $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        } else if ($this->isMatchesPartial([7, 33, 34, 39, 40], Attribute::yes())) {
            $vision = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}