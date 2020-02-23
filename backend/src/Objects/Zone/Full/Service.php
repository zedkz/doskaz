<?php


namespace App\Objects\Zone\Full;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;
use Symfony\Component\Validator\Constraints as Assert;

class Service extends Zone
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

    private const INDEX_REMAP = [
        1 => 1,
        2 => 2,
        3 => 6,
        4 => 7,
        5 => 3,
        6 => 4,
        7 => 5,
        8 => 8,
        9 => 9,
        10 => 10,
        11 => 11,
        12 => 12,
        13 => 13,
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
        $limb = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;

        if ($this->isMatchesAll(Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        if ($this->isMatches($this->remap([12]), Attribute::yes())) {
            $limb = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $vision = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $hearing = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $intellectual = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }

        if ($this->isMatchesPartial($this->remap([4, 6, 7, 8, 9, 11, 12, 13]), Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE;
        }
        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}
