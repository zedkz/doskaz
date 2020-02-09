<?php


namespace App\Objects\Adding\Steps;


use App\Objects\Zone\Middle\Entrance;
use Symfony\Component\Validator\Constraints as Assert;

class EntranceStep
{
    /**
     * @Assert\NotBlank()
     * @var Entrance|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}