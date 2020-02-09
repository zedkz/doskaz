<?php


namespace App\Objects\Zone\Middle;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Toilet extends Zone
{
    /**
     * Расчётная численность посетителей более 50 человек
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute1;

    /**
     * Продолжительности нахождения в здании более 60 минут
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute2;

    /**
     * Дверь открывается наружу
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute3;

    /**
     * Снаружи размещена криптограмма
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute4;

    /**
     * Ширина двери не менее 1,2 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute5;

    /**
     * Поручни на внутренней стороне двери длиной не менее 60 см
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
     * Размеры универсальной кабины не менее 1,65 х 2,0 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute8;

    /**
     * Крючки для одежды
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute9;

    /**
     * Крючки для костылей
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute10;

    /**
     * Крючки для других принадлежностей
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute11;

    /**
     * Зеркало
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute12;

    /**
     * Дозатор с мылом
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute13;

    /**
     * Диспенсер для туалетной бумаги и салфеток
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute14;

    /**
     * Электрическая сушилка для рук
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute15;

    /**
     * Урна
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute16;

    /**
     * Открывающиеся части предметов на высоте от 1,0 до 1,2 м
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute17;

    /**
     * На высоте от 40 см до 60 см над уровнем пола
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute18;

    /**
     * На расстоянии от края унитаза от 15 см до 30 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute19;

    /**
     * Указатель «Кнопка экстренного вызова»
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute20;

    public function calculateScore(): AccessibilityScore
    {
        $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;

        if ($this->isMatchesAll(Attribute::unknown())) {
            return AccessibilityScore::notAccessible();
        }
        if ($this->isMatchesAll(Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }

        if ($this->isMatchesAll(Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $vision = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        if ($this->isMatches([20], Attribute::yes())) {
            $intellectual = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }
        if ($this->isMatches([3, 4, 7, 8, 18, 19, 20], Attribute::no())) {
            $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        }
        if ($this->isMatches([3, 4, 18, 19, 20], Attribute::no())) {
            $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}