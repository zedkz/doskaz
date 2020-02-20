<?php


namespace App\Objects\Zone\Middle;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Movement extends Zone
{
    /**
     * Ширина коридора 1,5 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute1;

    /**
     * Твёрдые материалы
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute2;

    /**
     * Без зазоров
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute3;

    /**
     * Без вибрации при движении
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute4;

    /**
     * Предотвращающее скольжение
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute5;

    /**
     * Ширина дверей не менее 90 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute6;

    /**
     * Высота порогов не более 1,4 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute7;

    /**
     * Наличие предупреждения для слабовидящих на стеклянной двери
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute8;

    /**
     * Прямоугольник 10 х 20 см²
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute9;

    /**
     * Цвет яркий (контрастный)
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute10;

    /**
     * На высоте не ниже 1,2 м и не выше 1,5 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute11;

    /**
     * Контрастный цвет
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute12;

    /**
     * Тактильные указатели
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute13;

    /**
     * Ширина полосы 30 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute14;

    /**
     * Ширина марша лестниц не менее 1,35 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute15;

    /**
     * Ширина проступей лестниц не менее 30 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute16;

    /**
     * Высота подъема ступеней не более 15 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute17;

    /**
     * Максимальное число ступеней на пролет
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute18;

    /**
     * Вдоль обеих сторон
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute19;

    /**
     * На высоте 0,9 м для взрослых, 0,5 м для детей
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute20;

    /**
     * Горизонтальный закругленный вылет после последней опоры 30 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute21;

    /**
     * Твёрдые материалы
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute22;

    /**
     * Без зазоров
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute23;

    /**
     * Без вибрации при движении
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute24;

    /**
     * Предотвращающее скольжение
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute25;

    /**
     * Разворотные горизонтальные площадки
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute26;

    /**
     * Вдоль обеих сторон
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute27;

    /**
     * На высоте 0,7-0,9 м для взрослых, 0,5 м для детей
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute28;

    /**
     * Горизонтальный закругленный вылет после последней опоры 30 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute29;

    /**
     * Ширина марша не менее 1,2 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute30;

    /**
     * Высота марша 40-45 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute31;

    /**
     * Уклон
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute32;

    /**
     * Бортики не менее 5 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute33;

    /**
     * Габариты кабины лифта
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute34;

    /**
     * Ширина двери в кабину не менее 90 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute35;

    /**
     * Надписи, выполненные шрифтом Брайля на кнопках
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute36;

    /**
     * Не сенсорные кнопки
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute37;

    public function __construct()
    {
        foreach ($properties = (new \ReflectionClass($this))->getProperties() as $property) {
            $property->setValue($this, Attribute::unknown());
        }
    }

    public function calculateScore(): AccessibilityScore
    {
        if ($this->isMatchesAll(Attribute::yes())) {
            return AccessibilityScore::fullAccessible();
        }
        if ($this->isMatchesAll(Attribute::unknown())) {
            return AccessibilityScore::notAccessible();
        }
        if ($this->isMatchesAll(Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }

        $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_FULL_ACCESSIBLE;

        if ($this->isMatches([2, 3, 4, 5, 7, 8, 9, 10, 22, 23, 24, 25, 26, 27, 32], Attribute::no())) {
            $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        } else if ($this->isMatchesPartial([2, 3, 4, 5, 7, 8, 9, 10, 22, 23, 24, 25, 26, 27, 32], Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        }

        if ($this->isMatches([2, 3, 4, 5, 8, 9, 10, 36, 37], Attribute::no())) {
            $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        } else if ($this->isMatchesPartial([], Attribute::yes())) {
            $vision = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }

}