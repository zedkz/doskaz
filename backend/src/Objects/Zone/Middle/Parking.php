<?php


namespace App\Objects\Zone\Middle;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Parking extends Zone
{
    /**
     * Количество парковочных мест
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute1;

    /**
     * Размер парковки
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute2;

    /**
     * Знак на плоскости стоянки
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute3;

    /**
     * Знак на вертикальной поверхности (стене, столбе, стойке)
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute4;

    /**
     * Знак 5.15 «Место стоянки»
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute5;

    /**
     * Знак 7.15 «Инвалиды»
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute6;

    /**
     * Стрелка и расстояние
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute7;

    /**
     * Разметка на плоскости
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute8;

    /**
     * Съезд с тротуара на парковку
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute9;

    /**
     * Расстояние до входа в здание
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute10;

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
        $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;

        if ($this->isMatches([1, 2, 5, 6, 7, 8, 9], Attribute::no())) {
            $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        } else {
            $movement = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        }

        if ($this->isMatches([1, 2, 5, 6, 7, 8], Attribute::no())) {
            $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        } else {
            $vision = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        }

        if ($this->isMatchesAll(Attribute::no())) {
            $hearing = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}
