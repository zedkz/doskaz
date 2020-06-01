<?php


namespace App\Objects\Zone\Small;

use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;

class Navigation extends Zone
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
        if ($attribute->isEqualsTo(Attribute::yes())) {
            return AccessibilityScore::fullAccessible();
        }
        return AccessibilityScore::notAccessible();
    }
}
