<?php


namespace App\Objects\Zone\Full;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Parking extends Zone
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

    private const INDEX_REMAP = [
        1 => 1,
        2 => 2,
        5 => 3,
        6 => 4,
        7 => 5,
        8 => 6,
        9 => 7,
        10 => 8,
        12 => 9,
        16 => 10,
        3 => 11,
        4 => 12,
        11 => 13,
        13 => 14,
        14 => 15,
        15 => 16,
        17 => 17,
        18 => 18,
        19 => 19,
        20 => 20,
        21 => 21,
        22 => 22,
        23 => 23,
        24 => 24,
    ];

    private function remap(array $original)
    {
        return array_map(function ($key) {
            return self::INDEX_REMAP[$key];
        }, $original);
    }

    function calculateScore(): AccessibilityScore
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
        $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;

        if ($this->isMatches($this->remap([1, 2, 7, 8, 9, 11]), Attribute::no())) {
            $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        } elseif ($this->isMatchesPartial($this->remap([1, 2, 7, 8, 9, 11]), Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        }
        if ($this->isMatches($this->remap([1, 2, 7, 8, 9]), Attribute::no())) {
            $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        } else if ($this->isMatchesPartial($this->remap([1, 2, 7, 8, 9]), Attribute::yes())) {
            $vision = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}