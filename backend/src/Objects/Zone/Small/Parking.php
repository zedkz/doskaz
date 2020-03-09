<?php


namespace App\Objects\Zone\Small;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;

class Parking extends \App\Objects\Zone
{
    protected static function attributesKeys(): array
    {
        return ['attribute1'];
    }

    public function calculateScore(): AccessibilityScore
    {
        if($this->attributes->get('attribute1', Attribute::unknown())->isEqualsTo(Attribute::notProvided())) {
           return AccessibilityScore::notProvided();
        }

        $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;

        if($this->attributes->get('attribute1', Attribute::unknown())->isEqualsTo(Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $vision = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}