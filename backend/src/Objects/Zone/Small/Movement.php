<?php


namespace App\Objects\Zone\Small;


use App\Objects\Adding\AccessibilityScore;

class Movement extends \App\Objects\Zone
{
    protected static function attributesKeys(): array
    {
        return ['attribute1', 'attribute6', 'attribute7', 'attribute1000', 'attribute1001'];
    }

    public function calculateScore(): AccessibilityScore
    {
        return AccessibilityScore::notProvided();
    }

}