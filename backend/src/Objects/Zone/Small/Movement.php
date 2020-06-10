<?php


namespace App\Objects\Zone\Small;

use App\Objects\AccessibilityScoreBuilder;
use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\AttributesConfiguration;
use App\Objects\Zone;

class Movement extends Zone
{
    protected static function attributesKeys(): array
    {
        return AttributesConfiguration::getAttributesKeysForFormAndZone('small', 'movement');
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

        if($this->isMatches([1], Attribute::yes()) && $this->isMatchesAllExcept([1], Attribute::notProvided())) {
            return AccessibilityScore::fullAccessible();
        }

        $builder = AccessibilityScoreBuilder::initPartialAccessible();

        if ($this->isMatches([1000, 1001], Attribute::no()) || ($this->isMatchesPartial([1, 6, 7, 1000, 1001], Attribute::yes()) && !$this->isMatchesAll(Attribute::no()) && !$this->isMatchesAll(Attribute::unknown()))) {
            $builder->withMovementNotAccessible();
        }

        if ($this->isMatches([1, 6, 7], Attribute::yes())) {
            $builder->withLimbFullAccessible()
                ->withVisionFullAccessible()
                ->withIntellectualFullAccessible()
                ->withHearingFullAccessible();
        }

        return $builder->build();
    }
}
