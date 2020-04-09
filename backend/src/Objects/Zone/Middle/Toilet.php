<?php


namespace App\Objects\Zone\Middle;

use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Toilet extends Zone
{
    protected static function attributesKeys(): array
    {
        return array_merge(array_map(function ($key) {
            return 'attribute' . $key;
        }, range(1, 20)), [
            'attribute30', 'attribute33'
        ]);
    }

    public function calculateScore(): AccessibilityScore
    {
        $movement = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $limb = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;

        if ($this->isMatchesAll(Attribute::unknown()) || $this->isMatchesAll(Attribute::no())) {
            return AccessibilityScore::notAccessible();
        }
        if ($this->isMatchesAll(Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }

        if ($this->isMatches([1, 2], Attribute::no())) {
            $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}
