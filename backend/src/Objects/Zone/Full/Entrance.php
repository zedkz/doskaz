<?php


namespace App\Objects\Zone\Full;

use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\AttributesConfiguration;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Entrance extends Zone
{
    private const INDEX_REMAP = [
        1 => 41,
        2 => 42,
        3 => 43,
        4 => 1,
        5 => 2,
        6 => 3,
        7 => 4,
        8 => 5,
        9 => 6,
        10 => 7,
        11 => 8,
        12 => 9,
        13 => 10,
        14 => 11,
        15 => 12,
        16 => 13,
        17 => 14,
        18 => 15,
        19 => 44,
        20 => 45,
        21 => 16,
        22 => 46,
        23 => 47,
        24 => 17,
        25 => 18,
        26 => 19,
        27 => 20,
        28 => 21,
        29 => 48,
        30 => 49,
        31 => 50,
        32 => 22,
        33 => 51,
        34 => 23,
        35 => 24,
        36 => 25,
        37 => 26,
        38 => 52,
        39 => 27,
        40 => 28,
        41 => 53,
        42 => 29,
        43 => 30,
        44 => 31,
        45 => 54,
        46 => 55,
        47 => 56,
        48 => 57,
        49 => 58,
        50 => 32,
        51 => 33,
        52 => 34,
        53 => 35,
        54 => 36,
        55 => 37,
        56 => 38,
        57 => 39,
        58 => 40,
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

        if ($this->isMatches($this->remap([4]), Attribute::yes()) || $this->isMatchesAllExcept($this->remap([4]), Attribute::yes())) {
            return AccessibilityScore::fullAccessible();
        }

        $movement = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $limb = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;

        if ($this->isMatches($this->remap([4]), Attribute::no()) && $this->isMatches([18], Attribute::no())) {
            $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }

    protected static function attributesKeys(): array
    {
        AttributesConfiguration::getAttributesKeysForFormAndZone('full', 'entrance');
    }
}
