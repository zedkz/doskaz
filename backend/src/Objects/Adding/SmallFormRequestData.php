<?php


namespace App\Objects\Adding;

use App\Infrastructure\ObjectResolver\DataObject;
use App\Objects\Adding\Steps\FirstStep;
use App\Objects\Adding\Steps\Small\Entrance;
use App\Objects\Adding\Steps\Small\Movement;
use App\Objects\Adding\Steps\Small\Navigation;
use App\Objects\Adding\Steps\Small\Parking;
use App\Objects\Adding\Steps\Small\Service;
use App\Objects\Adding\Steps\Small\ServiceAccessibility;
use App\Objects\Adding\Steps\Small\Toilet;
use App\Objects\Zone\Small\SmallFormZones;
use App\Objects\Zones;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class MiddleFormRequestData
 * @package App\Objects\Adding
 */
final class SmallFormRequestData implements DataObject, Form
{
    /**
     * @var FirstStep
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    public $first;

    /**
     * @Assert\Valid()
     * @Assert\NotBlank()
     * @var Parking
     */
    public $parking;

    /**
     * @var Entrance
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $entrance1;

    /**
     * @var Entrance|null
     * @Assert\Valid()
     */
    public $entrance2;

    /**
     * @var Entrance|null
     * @Assert\Valid()
     */
    public $entrance3;

    /**
     * @var Movement|null
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $movement;

    /**
     * @var Service|null
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $service;

    /**
     * @var Toilet|null
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $toilet;

    /**
     * @var Navigation|null
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $navigation;

    /**
     * @var ServiceAccessibility|null
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $serviceAccessibility;

    public function toZones(): Zones
    {
        return new SmallFormZones(
            new \App\Objects\Zone\Small\Parking($this->parking->attributes),
            new \App\Objects\Zone\Small\Entrance($this->entrance1->attributes),
            new \App\Objects\Zone\Small\Movement($this->movement->attributes),
            new \App\Objects\Zone\Small\Service($this->service->attributes),
            new \App\Objects\Zone\Small\Toilet($this->toilet->attributes),
            new \App\Objects\Zone\Small\Navigation($this->navigation->attributes),
            new \App\Objects\Zone\Small\ServiceAccessibility($this->serviceAccessibility->attributes)
        );
    }
}
