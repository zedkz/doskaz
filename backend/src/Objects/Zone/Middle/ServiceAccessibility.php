<?php


namespace App\Objects\Zone\Middle;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class ServiceAccessibility extends Zone
{
    /**
     * Универсальный проект
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute1;

    /**
     * Разумное приспособление
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute2;

    /**
     * Есть доставка товаров или вызов специалиста на дом
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute3;

    /**
     * Кнопка вызова персонала
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute4;

    /**
     * Оказание ситуационной помощи со стороны персонала
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute5;

    /**
     * Протоколы/инструкции по коммуникации и оказанию помощи маломобильным гражданам
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute6;

    /**
     * Льготы для людей с инвалидностью 1, 2, 3 групп, пожилых, детей
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute7;

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
        $hearing = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;

        if ($this->isMatchesPartial([1, 2], Attribute::yes()) && $this->isMatches([4, 5], Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $vision = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        if ($this->isMatches([1, 2, 5], Attribute::yes())) {
            $hearing = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}