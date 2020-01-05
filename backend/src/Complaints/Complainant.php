<?php
declare(strict_types=1);

namespace App\Complaints;

use Goodwix\DoctrineJsonOdm\Annotation\ODM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM()
 */
final class Complainant
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $firstName;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $lastName;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $middleName;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(12)
     * @Assert\Regex(pattern="/^\d+$/")
     */
    public $iin;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $address;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $phone;
}