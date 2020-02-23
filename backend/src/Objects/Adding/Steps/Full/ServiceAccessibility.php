<?php


namespace App\Objects\Adding\Steps\Full;
use Symfony\Component\Validator\Constraints as Assert;

class ServiceAccessibility
{
    /**
     * @Assert\NotBlank()
     * @var \App\Objects\Zone\Full\ServiceAccessibility|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}