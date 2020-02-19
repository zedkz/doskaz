<?php


namespace App\Objects\Zone\Full;


use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use App\Objects\Zone;

class Parking extends Zone
{
    /**
     * Количество парковочных мест
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute1;

    /**
     * Размер парковки
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute2;

    /**
     * Знак на плоскости стоянки
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute3;

    /**
     * Знак на вертикальной поверхности (стене, столбе, стойке)
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute4;

    /**
     * Знак 5.15 «Место стоянки»
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute5;

    /**
     * Знак 7.15 «Инвалиды»
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute6;

    /**
     * Стрелка и расстояние
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute7;

    /**
     * Разметка на плоскости
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute8;

    /**
     * Съезд с тротуара на парковку
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute9;

    /**
     * Расстояние до входа в здание
     * @var Attribute|null
     * @Assert\NotBlank()
     */
    public $attribute10;

    function calculateScore(): AccessibilityScore
    {
        // TODO: Implement calculateScore() method.
    }
}