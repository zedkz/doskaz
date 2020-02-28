<?php


namespace App\Objects\Zone\Full;

use App\Objects\Adding\AccessibilityScore;
use App\Objects\Zones;

class FullFormZones implements Zones
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
     * @var Entrance|null
     */
    public $entrance2;

    /**
     * @var Entrance|null
     */
    public $entrance3;

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
     * Zones constructor.
     * @param Parking $parking
     * @param Entrance $entrance1
     * @param Entrance|null $entrance2
     * @param Entrance|null $entrance3
     * @param Movement $movement
     * @param Service $service
     * @param Toilet $toilet
     * @param Navigation $navigation
     * @param ServiceAccessibility $serviceAccessibility
     */
    public function __construct(
        Parking $parking,
        Entrance $entrance1,
        ?Entrance $entrance2,
        ?Entrance $entrance3,
        Movement $movement,
        Service $service,
        Toilet $toilet,
        Navigation $navigation,
        ServiceAccessibility $serviceAccessibility
    ) {
        $this->parking = $parking;
        $this->entrance1 = $entrance1;
        $this->entrance2 = $entrance2;
        $this->entrance3 = $entrance3;
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
