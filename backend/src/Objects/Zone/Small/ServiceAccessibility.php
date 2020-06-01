<?php


namespace App\Objects\Zone\Small;

use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;

class ServiceAccessibility extends Zone
{
    protected static function attributesKeys(): array
    {
        return ['attribute2'];
    }

    public function calculateScore(): AccessibilityScore
    {
        if ($this->isMatchesAll(Attribute::yes())) {
            return AccessibilityScore::fullAccessible();
        }
        if ($this->isMatchesAll(Attribute::no())) {
            return AccessibilityScore::notAccessible();
        }
        if ($this->isMatchesAll(Attribute::unknown()) || $this->isMatchesAll(Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }

        return AccessibilityScore::partialAccessible();
    }
}
