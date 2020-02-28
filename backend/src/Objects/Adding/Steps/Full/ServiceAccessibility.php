<?php


namespace App\Objects\Adding\Steps\Full;

use App\Objects\AttributesMap;
use Symfony\Component\Validator\Constraints as Assert;

class ServiceAccessibility
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
