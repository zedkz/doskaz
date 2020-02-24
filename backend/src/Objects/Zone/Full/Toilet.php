<?php


namespace App\Objects\Zone\Full;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Toilet extends Zone
{
    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute1;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute2;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute3;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute4;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute5;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute6;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute7;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute8;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute9;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute10;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute11;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute12;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute13;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute14;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute15;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute16;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute17;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute18;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute19;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute20;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute21;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute22;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute23;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute24;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute25;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute26;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute27;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute28;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute29;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute30;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute31;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute32;

    /**
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute33;

    private const INDEX_REMAP = [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 21,
        9 => 22,
        10 => 8,
        11 => 23,
        12 => 24,
        13 => 25,
        14 => 26,
        15 => 27,
        16 => 28,
        17 => 29,
        18 => 30,
        19 => 31,
        20 => 32,
        21 => 33,
        22 => 9,
        23 => 10,
        24 => 11,
        25 => 12,
        26 => 13,
        27 => 14,
        28 => 15,
        29 => 16,
        30 => 17,
        31 => 18,
        32 => 19,
        33 => 20,
    ];

    private function remap(array $original)
    {
        return array_map(function ($key) {
            return self::INDEX_REMAP[$key];
        }, $original);
    }

    function calculateScore(): AccessibilityScore
    {
        if ($this->isMatchesAll(Attribute::unknown())) {
            return AccessibilityScore::notAccessible();
        }
        if ($this->isMatchesAll(Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }

        $movement = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $limb = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;

        if ($this->isMatchesAll(Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $vision = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        if ($this->isMatches($this->remap([20]), Attribute::yes())) {
            $intellectual = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        if ($this->isMatches($this->remap([3, 4, 7, 10, 11, 12, 13, 16, 18, 19, 20, 21, 31, 32, 33]), Attribute::no())) {
            $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        }
        if ($this->isMatches($this->remap([3, 4, 18, 19, 20, 31, 32, 33]), Attribute::no())) {
            $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        }
        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}