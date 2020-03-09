<?php


namespace App\Objects\Zone\Small;

use App\Objects\Adding\AccessibilityScore;
use App\Objects\Zones;

class SmallFormZones extends Zones
{
    /**
     * @var Parking
     */
    public $parking;

    /**
     * @var Entrance
     */
    public $entrance1;

    /**
     * @var null
     */
    public $entrance2 = null;

    /**
     * @var null
     */
    public $entrance3 = null;

    /**
     * @var Movement
     */
    public $movement;

    /**
     * @var Service
     */
    public $service;

    /**
     * @var Toilet
     */
    public $toilet;

    /**
     * @var Navigation
     */
    public $navigation;

    /**
     * @var ServiceAccessibility
     */
    public $serviceAccessibility;

    /**
     * SmallFormZones constructor.
     * @param Parking $parking
     * @param Entrance $entrance1
     * @param Movement $movement
     * @param Service $service
     * @param Toilet $toilet
     * @param Navigation $navigation
     * @param ServiceAccessibility $serviceAccessibility
     */
    public function __construct(Parking $parking, Entrance $entrance1, Movement $movement, Service $service, Toilet $toilet, Navigation $navigation, ServiceAccessibility $serviceAccessibility)
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
