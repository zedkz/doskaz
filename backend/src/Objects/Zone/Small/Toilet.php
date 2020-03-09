<?php


namespace App\Objects\Zone\Small;


use App\Objects\Adding\AccessibilityScore;

class Toilet extends \App\Objects\Zone
{
    protected static function attributesKeys(): array
    {
        return ['attribute1000', 'attribute2'];
    }

    public function calculateScore(): AccessibilityScore
    {
        return AccessibilityScore::notProvided();
    }

}