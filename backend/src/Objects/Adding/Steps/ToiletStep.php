<?php


namespace App\Objects\Adding\Steps;


use App\Objects\Zone\Middle\Toilet;
use Symfony\Component\Validator\Constraints as Assert;

class ToiletStep
{
    /**
     * @Assert\NotBlank()
     * @var Toilet|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}