<?php


namespace App\Objects\Zone\Full;

use App\Objects\AccessibilityScoreBuilder;
use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\AttributesConfiguration;
use App\Objects\Zone;

class Movement extends Zone
{
    protected static function attributesKeys(): array
    {
        return AttributesConfiguration::getAttributesKeysForFormAndZone('full', 'movement');
    }

    private const INDEX_REMAP = [
        1 => 1,
        2 => 38,
        3 => 39,
        4 => 40,
        5 => 2,
        6 => 3,
        7 => 4,
        8 => 5,
        9 => 41,
        10 => 42,
        11 => 43,
        12 => 44,
        13 => 45,
        14 => 6,
        15 => 7,
        16 => 8,
        17 => 9,
        18 => 10,
        19 => 11,
        20 => 12,
        21 => 13,
        22 => 14,
        23 => 15,
        24 => 16,
        25 => 17,
        26 => 46,
        27 => 18,
        28 => 19,
        29 => 20,
        30 => 47,
        31 => 48,
        32 => 21,
        33 => 22,
        34 => 23,
        35 => 24,
        36 => 25,
        37 => 49,
        38 => 50,
        39 => 26,
        40 => 51,
        41 => 27,
        42 => 28,
        43 => 52,
        44 => 53,
        45 => 54,
        46 => 29,
        47 => 30,
        48 => 31,
        49 => 32,
        50 => 33,
        51 => 34,
        52 => 35,
        53 => 55,
        54 => 56,
        55 => 57,
        56 => 36,
        57 => 37,
        58 => 58,
        59 => 59,
        60 => 60,
        61 => 61,
        62 => 62,
        63 => 63,
    ];

    private function remap(array $original)
    {
        return array_map(function ($key) {
            return self::INDEX_REMAP[$key];
        }, $original);
    }

    public function calculateScore(): AccessibilityScore
    {
        if ($this->isMatchesAll(Attribute::yes())) {
            return AccessibilityScore::fullAccessible();
        }
        if ($this->isMatchesAll(Attribute::unknown())) {
            return AccessibilityScore::unknown();
        }
        if ($this->isMatchesAll(Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }

        $builder = AccessibilityScoreBuilder::initPartialAccessible();

        if ($this->isMatches([32, 70, 61, 62], Attribute::no())) {
            $builder->withMovementNotAccessible();
        }

        if ($this->isMatchesAllExcept([22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 50, 53, 54, 70, 34, 35, 55, 56, 57, 36, 58, 60, 61, 62, 63], Attribute::yes())) {
            $builder->withHearingFullAccessible()
                ->withIntellectualFullAccessible()
                ->withLimbFullAccessible();
        }

        if ($this->isMatchesAllExcept([22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 50, 53, 54, 70, 34, 35, 55, 56, 57, 60, 61, 62, 63], Attribute::yes())) {
            $builder->withVisionFullAccessible();
        }

        if ($this->isMatchesAllExcept([36, 58, 12, 13, 14, 15, 16, 17, 18, 19, 20, 47, 48, 21], Attribute::yes())) {
            $builder->withMovementFullAccessible();
        }

        return $builder->build();
    }
}
