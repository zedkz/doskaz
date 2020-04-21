<?php


namespace App\Users;


use App\Infrastructure\ObjectResolver\DataObject;
use App\Tasks\CurrentTaskData;
use Symfony\Component\Validator\Constraints as Assert;

class ProfileData
{
    /**
     * @var string|null
     */
    public $email;

    public $phone;

    public $avatar;

    /**
     * @var string|null
     */
    public $firstName;

    /**
     * @var string|null
     */
    public $lastName;

    /**
     * @var string|null
     */
    public $middleName;

    public $currentTask;

    public $level;

    public $stats;

    /**
     * @var UserAbilities
     */
    public $abilities;

    /**
     * ProfileData constructor.
     * @param $name
     * @param $email
     * @param $phone
     * @param $roles
     * @param $avatar
     * @param $firstName
     * @param $lastName
     * @param $middleName
     * @param CurrentTaskData|null $currentTask
     * @param $level
     * @param $stats
     * @param UserAbilities $abilities
     */
    public function __construct($email, $phone, $avatar, $firstName, $lastName, $middleName, ?CurrentTaskData $currentTask, $level, $stats, UserAbilities $abilities)
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->avatar = $avatar;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
        $this->currentTask = $currentTask;
        $this->level = $level;
        $this->stats = $stats;
        $this->abilities = $abilities;
    }
}