<?php


namespace App\Objects\Zone\Middle;

use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\AttributesConfiguration;
use App\Objects\AttributesMap;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Entrance extends Zone
{
    protected static function attributesKeys(): array
    {
        AttributesConfiguration::getAttributesKeysForFormAndZone('middle', 'entrance');
    }

    public function calculateScore(): AccessibilityScore
    {
        if ($this->isMatches([1], Attribute::yes()) || $this->isMatchesAllExcept([1], Attribute::yes())) {
            return AccessibilityScore::fullAccessible();
        }

        $movement = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $limb = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;

        if ($this->isMatchesAll(Attribute::unknown())) {
            return AccessibilityScore::notAccessible();
        }

        if ($this->isMatchesAll(Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }

        if ($this->isMatches([1, 18], Attribute::no())) {
            $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}
