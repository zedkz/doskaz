<?php


namespace App\Objects\Adding\Steps\Full;

use Symfony\Component\Validator\Constraints as Assert;
class Navigation
{
    /**
     * @Assert\NotBlank()
     * @var \App\Objects\Zone\Full\Navigation|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}