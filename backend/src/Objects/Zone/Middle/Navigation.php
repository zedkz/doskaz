<?php


namespace App\Objects\Zone\Middle;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Navigation extends Zone
{
    /**
     * Указатели и информационный материал
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute1;

    /**
     * Форматы информации
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute2;

    /**
     * Знаки и символы
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute3;

    /**
     * Форматы информации
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute4;

    /**
     * Рельефные тактильные обозначения путей движения
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute5;

    /**
     * Непрерывные тактильные обозначения путей движения
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute6;

    /**
     * Мнемосхема
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

        if ($this->isMatches([3, 4], Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $hearing = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        } else if ($this->isMatches([3, 4], Attribute::no())) {
            $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
            $hearing = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        }

        if ($this->isMatchesAll(Attribute::yes())) {
            $vision = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}