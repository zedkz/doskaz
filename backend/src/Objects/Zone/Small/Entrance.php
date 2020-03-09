<?php


namespace App\Objects\Zone\Small;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;

class Entrance extends Zone
{
    protected static function attributesKeys(): array
    {
        return ['attribute1', 'attribute1000', 'attribute1001', 'attribute30', 'attribute31', 'attribute1002'];
    }

    public function calculateScore(): AccessibilityScore
    {
        if($this->isMatchesAll(Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }

        $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;

        if($this->isMatches([1], Attribute::yes())) {
            $limb = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $vision = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        if($this->isMatches([1, 31, 1002], Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        if($this->isMatches([1000, 1001, 30, 31, 10002], Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        if($this->isMatches([1000, 1001, 31, 10002], Attribute::yes())) {
            $limb = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        if($this->isMatches([31, 10002], Attribute::yes())) {
            $vision = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        return AccessibilityScore::notProvided();
    }

}