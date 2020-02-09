<?php


namespace App\Objects\Adding\Steps;


use App\Objects\Zone\Middle\Parking;
use Symfony\Component\Validator\Constraints as Assert;

class ParkingStep
{
    /**
     * @Assert\NotBlank()
     * @var Parking|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}