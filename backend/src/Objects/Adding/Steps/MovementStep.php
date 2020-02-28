<?php


namespace App\Objects\Adding\Steps;


use App\Objects\AttributesMap;
use App\Objects\Zone\Middle\Movement;
use Symfony\Component\Validator\Constraints as Assert;

class MovementStep
{
    /**
     * @Assert\NotBlank()
     * @var AttributesMap|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}