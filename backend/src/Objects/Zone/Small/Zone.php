<?php


namespace App\Objects\Zone\Small;


use App\Objects\Adding\AccessibilityScore;

class Zone extends \App\Objects\Zone
{
    /**
     * @var AccessibilityScore
     */
    public $score;

    /**
     * Zone constructor.
     * @param AccessibilityScore $score
     */
    public function __construct(AccessibilityScore $score)
    {
        $this->score = $score;
    }

    function calculateScore(): AccessibilityScore
    {
        return $this->score;
    }
}