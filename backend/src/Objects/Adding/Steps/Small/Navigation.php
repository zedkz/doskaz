<?php


namespace App\Objects\Adding\Steps\Small;

use App\Objects\AttributesMap;
use Symfony\Component\Validator\Constraints as Assert;

class Navigation
{
    /**
     * @Assert\NotBlank()
     * @var AttributesMap
     */
    public $attributes;

    /**
     * @var string|null
     */
    public $comment;
}