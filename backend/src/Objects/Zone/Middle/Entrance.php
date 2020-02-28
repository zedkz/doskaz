<?php


namespace App\Objects\Zone\Middle;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\AttributesMap;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Entrance extends Zone
{
    protected static function attributesKeys(): array
    {
        return array_map(function ($key) {
            return 'attribute' . $key;
        }, range(1, 40));
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