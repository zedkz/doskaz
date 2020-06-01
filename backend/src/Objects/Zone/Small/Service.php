<?php


namespace App\Objects\Zone\Small;

use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;

class Service extends Zone
{
    protected static function attributesKeys(): array
    {
        return ['attribute1000'];
    }

    public function calculateScore(): AccessibilityScore
    {
        /**
         * @var $attribute Attribute
         */
        $attribute = $this->attributes->get('attribute1000');

        if ($attribute->isEqualsTo(Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }

        $movement = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $limb = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        $vision = AccessibilityScore::SCORE_NOT_ACCESSIBLE;
        $hearing = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        $intellectual = AccessibilityScore::SCORE_FULL_ACCESSIBLE;

        if ($attribute->isEqualsTo(Attribute::yes())) {
            $movement = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
            $vision = AccessibilityScore::SCORE_FULL_ACCESSIBLE;
        }
        return AccessibilityScore::new($movement, $limb, $vision, $hearing, $intellectual);
    }
}
