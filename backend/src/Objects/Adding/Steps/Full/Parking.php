<?php


namespace App\Objects\Adding\Steps\Full;


use Symfony\Component\Validator\Constraints as Assert;

class Parking
{
    /**
     * @Assert\NotBlank()
     * @var \App\Objects\Zone\Full\Parking|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}