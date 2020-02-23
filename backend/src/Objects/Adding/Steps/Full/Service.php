<?php


namespace App\Objects\Adding\Steps\Full;

use Symfony\Component\Validator\Constraints as Assert;
class Service
{
    /**
     * @Assert\NotBlank()
     * @var \App\Objects\Zone\Full\Service|null
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}