<?php


namespace App\Objects\Zone\Full;

use App\Objects\AccessibilityScoreBuilder;
use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\AttributesConfiguration;
use App\Objects\Zone;

class Navigation extends Zone
{
    protected static function attributesKeys(): array
    {
        return AttributesConfiguration::getAttributesKeysForFormAndZone('full', 'navigation');
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

        if ($this->isMatches([5, 16, 6, 17, 18, 19, 20, 21, 7], Attribute::no())) {
            return AccessibilityScore::notAccessible();
        }

        $builder = AccessibilityScoreBuilder::initPartialAccessible();

        if ($this->isMatches([1, 2, 3, 4, 8, 9, 10, 11, 12, 5, 16, 6, 17, 18, 19, 20, 21, 7], Attribute::yes()) && $this->isMatchesPartial([13, 14, 15], Attribute::yes())) {
            $builder->withHearingFullAccessible();
        }
        if ($this->isMatches([1, 2, 3, 4, 8, 9, 10, 11, 12, 5, 16, 6, 17, 18, 19, 20, 21, 7, 15], Attribute::yes())) {
            $builder->withIntellectualFullAccessible();
        }
        if ($this->isMatches([1, 2, 3, 4, 8, 9, 10, 11, 12, 5, 16, 6, 17, 18, 19, 20, 21, 7], Attribute::yes())) {
            $builder->withMovementFullAccessible()
                ->withLimbFullAccessible()
                ->withVisionFullAccessible();
        }

        return $builder->build();
    }
}
