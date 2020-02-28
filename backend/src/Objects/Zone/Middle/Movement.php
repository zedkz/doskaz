<?php


namespace App\Objects\Zone\Middle;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Movement extends Zone
{
    protected static function attributesKeys(): array
    {
        return array_map(function ($key) {
            return 'attribute'.$key;
        }, range(1, 37));
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