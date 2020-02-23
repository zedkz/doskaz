<?php


namespace App\Objects\Adding\Steps\Full;
use Symfony\Component\Validator\Constraints as Assert;

class Movement
{
    /**
     * @Assert\NotBlank()
     * @var \App\Objects\Zone\Full\Movement|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}