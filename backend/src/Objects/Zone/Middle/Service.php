<?php


namespace App\Objects\Zone\Middle;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Service extends Zone
{
    /**
     * Высота не более 80 см от уровня пола
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute1;

    /**
     * Коленное пространство не менее 70 см
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute2;

    /**
     * Опознавательные таблички
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute3;

    /**
     * При расположении сбоку от посетителя — не выше 1,4 м и не ниже 0,3 от уровня пола
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute4;

    /**
     * При фронтальном подходе — не выше 1,2 м и не ниже 0,4 м от уровня пола
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute5;

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
        $limb = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_FULL_ACCESSIBLE;

        if ($this->isMatches([4, 5], Attribute::no())) {
            $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        }
        else if (($this->isMatches([4, 5], Attribute::yes())) || $this->isMatchesPartial([4, 5], Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}