<?php


namespace App\Objects\Adding;


use App\Infrastructure\ObjectResolver\DataObject;
use App\Objects\Adding\Steps\EntranceStep;
use App\Objects\Adding\Steps\FirstStep;
use App\Objects\Adding\Steps\MovementStep;
use App\Objects\Adding\Steps\NavigationStep;
use App\Objects\Adding\Steps\ParkingStep;
use App\Objects\Adding\Steps\ServiceAccessibilityStep;
use App\Objects\Adding\Steps\ServiceStep;
use App\Objects\Adding\Steps\ToiletStep;
use Symfony\Component\Validator\Constraints as Assert;

class MiddleFormRequestData implements DataObject
{
    /**
     * @var FirstStep|null
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    public $first;

    /**
     * @Assert\Valid()
     * @Assert\NotBlank()
     * @var ParkingStep|null
     */
    public $parking;

    /**
     * @var EntranceStep|null
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $entrance1;

    /**
     * @var EntranceStep|null
     * @Assert\Valid()
     */
    public $entrance2;

    /**
     * @var EntranceStep|null
     * @Assert\Valid()
     */
    public $entrance3;

    /**
     * @var MovementStep|null
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $movement;

    /**
     * @var ServiceStep|null
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $service;

    /**
     * @var ToiletStep|null
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $toilet;

    /**
     * @var NavigationStep|null
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $navigation;

    /**
     * @var ServiceAccessibilityStep|null
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $serviceAccessibility;
}