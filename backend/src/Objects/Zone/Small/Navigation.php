<?php


namespace App\Objects\Zone\Small;


use App\Objects\Adding\AccessibilityScore;

class Navigation extends \App\Objects\Zone
{
    protected static function attributesKeys(): array
    {
        return ['attribute1000'];
    }

    public function calculateScore(): AccessibilityScore
    {
        return AccessibilityScore::notProvided();
    }

}