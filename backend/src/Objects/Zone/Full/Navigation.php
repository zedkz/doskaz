<?php


namespace App\Objects\Zone\Full;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Navigation extends Zone
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

    function calculateScore(): AccessibilityScore
    {
        if ($this->isMatchesAll(Attribute::unknown())) {
            return AccessibilityScore::notAccessible();
        }
        if ($this->isMatchesAll(Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }

        $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $limb = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_NOT_ACCESSIBLE;

        if ($this->isMatches($this->remap([3, 4, 5, 6, 7]), Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $limb = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $hearing = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        if ($this->isMatchesAllExcept($this->remap([12]), Attribute::yes())) {
            $vision = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}
