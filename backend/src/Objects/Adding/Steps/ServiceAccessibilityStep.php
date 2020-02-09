<?php


namespace App\Objects\Adding\Steps;


use App\Objects\Zone\Middle\ServiceAccessibility;
use Symfony\Component\Validator\Constraints as Assert;

class ServiceAccessibilityStep
{
    /**
     * @Assert\NotBlank()
     * @var ServiceAccessibility|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}