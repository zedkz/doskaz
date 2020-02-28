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
        parent::__construct(null);
        $this->score = $score;
    }

    protected static function attributesKeys(): array
    {
        return [];
    }

    public function calculateScore(): AccessibilityScore
    {
        return $this->score;
    }
}
