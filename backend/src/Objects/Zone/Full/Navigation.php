<?php


namespace App\Objects\Zone\Full;

use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\AttributesConfiguration;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Navigation extends Zone
{
    protected static function attributesKeys(): array
    {
        return AttributesConfiguration::getAttributesKeysForFormAndZone('full', 'navigation');
    }

    private const INDEX_REMAP = [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 8,
        6 => 9,
        7 => 10,
        8 => 11,
        9 => 12,
        10 => 13,
        11 => 14,
        12 => 15,
        13 => 5,
        14 => 16,
        15 => 6,
        16 => 17,
        17 => 18,
        18 => 19,
        19 => 20,
        20 => 21,
        21 => 22,
        22 => 7,
    ];

    private function remap(array $original)
    {
        return array_map(function ($key) {
            return self::INDEX_REMAP[$key];
        }, $original);
    }

    public function calculateScore(): AccessibilityScore
    {
        if ($this->isMatchesAll(Attribute::unknown())) {
            return AccessibilityScore::notAccessible();
        }
        if ($this->isMatchesAll(Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }
        if ($this->isMatchesAll(Attribute::yes())) {
            return AccessibilityScore::fullAccessible();
        }

        return AccessibilityScore::partialAccessible();
    }
}
