<?php


namespace App\Objects\Adding\Steps;


use Symfony\Component\Validator\Constraints as Assert;

class FirstStep
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $address;

    /**
     * @var string|int|null
     * @Assert\NotBlank()
     */
    public $categoryId;

    /**
     * @var array|null
     * @Assert\NotBlank()
     */
    public $point = [];

    /**
     * @var string[]
     */
    public $videos = [];

    /**
     * @var string[]
     * @Assert\Count(min=0)
     */
    public $photos = [];
}