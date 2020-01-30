<?php


namespace App\Objects\Adding;


use OpenApi\Annotations\Items;
use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Schema(title="Общая информация", schema="CommonStep")
 */
class CommonStep
{
    /**
     * @Property(type="string", nullable=true, description="Наименование")
     * @Assert\NotBlank()
     * @var string|null
     */
    public $name;

    /**
     * @Property(type="string", nullable=true, description="Адрес")
     * @Assert\NotBlank()
     * @var string|null
     */
    public $address;

    /**
     * @Property()
     */
    public $coordinates;

    /**
     * @Property(type="string", nullable=true, description="Id категории")
     * @var string|int|null
     * @Assert\NotBlank()
     */
    public $categoryId;

    /**
     * @Assert\NotBlank()
     * @Property(type="array", @Items(type="string"), description="Ссылки на видео")
     */
    public $videos;

    /**
     * @Assert\NotBlank()
     * @Property(type="array", @Items(type="string"), description="Фото")
     */
    public $photos;

}