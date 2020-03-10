<?php


namespace App\Objects\Zone\Small;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Zone;

class ServiceAccessibility extends Zone
{
    protected static function attributesKeys(): array
    {
        return [];
    }

    public function calculateScore(): AccessibilityScore
    {
        return AccessibilityScore::notProvided();
    }

}