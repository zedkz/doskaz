<?php


namespace App\Objects\Adding\Steps\Full;
use Symfony\Component\Validator\Constraints as Assert;

class Toilet
{
    /**
     * @Assert\NotBlank()
     * @var \App\Objects\Zone\Full\Toilet|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}