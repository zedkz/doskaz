<?php


namespace App\Objects\Zone\Small;


use App\Objects\Adding\AccessibilityScore;

class ServiceAccessibility extends \App\Objects\Zone
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