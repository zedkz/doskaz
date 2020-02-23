<?php


namespace App\Objects\Adding\Steps\Full;
use Symfony\Component\Validator\Constraints as Assert;

class Entrance
{
    /**
     * @Assert\NotBlank()
     * @var \App\Objects\Zone\Full\Entrance|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}