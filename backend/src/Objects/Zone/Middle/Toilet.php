<?php


namespace App\Objects\Zone\Middle;

use App\Objects\AccessibilityScoreBuilder;
use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\AttributesConfiguration;
use App\Objects\Zone;

class Toilet extends Zone
{
    protected static function attributesKeys(): array
    {
        return AttributesConfiguration::getAttributesKeysForFormAndZone('middle', 'toilet');
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

        if (!$this->isMatches([30, 33], Attribute::yes())) {
            $builder->withMovementNotAccessible();
        }
        if ($this->isMatches([1, 2], Attribute::no()) || $this->isMatches([1, 2], Attribute::notProvided())) {
            return AccessibilityScore::notProvided();
        }
        if ($this->isMatches([1, 2], Attribute::yes()) && $this->isMatchesAllExcept([1, 2], Attribute::no())) {
            $builder->withHearingPartialAccessible()
                ->withVisionFullAccessible()
                ->withHearingPartialAccessible()
                ->withIntellectualFullAccessible()
                ->withLimbFullAccessible();
        }

        return $builder->build();
    }
}
