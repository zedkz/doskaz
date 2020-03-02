<?php


namespace App\Objects\Zone\Small;

use App\Objects\Adding\AccessibilityScore;
use App\Objects\Zones;

class SmallFormZones extends Zones
{
    /**
     * @var Zone
     */
    public $parking;

    /**
     * @var Zone
     */
    public $entrance1;

    /**
     * @var Zone
     */
    public $movement;

    /**
     * @var Zone
     */
    public $service;

    /**
     * @var Zone
     */
    public $toilet;

    /**
     * @var Zone
     */
    public $navigation;

    /**
     * @var Zone
     */
    public $serviceAccessibility;

    /**
     * SmallFormZones constructor.
     * @param Zone $parking
     * @param Zone $entrance1
     * @param Zone $movement
     * @param Zone $service
     * @param Zone $toilet
     * @param Zone $navigation
     * @param Zone $serviceAccessibility
     */
    public function __construct(Zone $parking, Zone $entrance1, Zone $movement, Zone $service, Zone $toilet, Zone $navigation, Zone $serviceAccessibility)
    {
        $this->parking = $parking;
        $this->entrance1 = $entrance1;
        $this->movement = $movement;
        $this->service = $service;
        $this->toilet = $toilet;
        $this->navigation = $navigation;
        $this->serviceAccessibility = $serviceAccessibility;
    }

    public function overallScore(): AccessibilityScore
    {
        return AccessibilityScore::average(
            $this->parking->accessibilityScore(),
            $this->entrance1->accessibilityScore(),
            $this->movement->accessibilityScore(),
            $this->service->accessibilityScore(),
            $this->toilet->accessibilityScore(),
            $this->navigation->accessibilityScore(),
            $this->serviceAccessibility->accessibilityScore()
        );
    }
}
