<?php
declare(strict_types=1);

namespace App\Complaints;

use Goodwix\DoctrineJsonOdm\Annotation\ODM;
use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM()
 * @Schema(title="Данные заявителя", schema="Complainant")
 */
final class Complainant
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Property(nullable=false, description="Имя")
     */
    public $firstName;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Property(nullable=false, description="Фамилия")
     */
    public $lastName;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Property(nullable=false, description="Отчество")
     */
    public $middleName;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(12)
     * @Assert\Regex(pattern="/^\d+$/")
     * @Property(nullable=false, description="ИИН")
     */
    public $iin;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Property(nullable=false, description="Номер телефона")
     * @Assert\Regex(pattern="/\+7\(\d{3}\)\d{3}-\d{2}-\d{2}/")
     */
    public $phone;

    /**
     * @var string|int
     * @Assert\NotBlank()
     * @Property(nullable=false, description="id города")
     */
    public $cityId;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Property(nullable=false, description="Улица")
     */
    public $street;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Property(nullable=false, description="Номер дома")
     */
    public $building;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Property(nullable=false, description="Квартира")
     */
    public $apartment;
}