<?php


namespace App\Objects\Adding\Steps;


use App\Objects\Zone\Middle\Navigation;
use Symfony\Component\Validator\Constraints as Assert;

class NavigationStep
{
    /**
     * @Assert\NotBlank()
     * @var Navigation|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}