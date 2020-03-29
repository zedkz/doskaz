<?php


namespace App\Users;


use App\Infrastructure\ObjectResolver\DataObject;
use App\Tasks\CurrentTaskData;
use Symfony\Component\Validator\Constraints as Assert;

class ProfileData
{
    public $id;

    public $name;

    /**
     * @var string|null
     */
    public $email;

    public $phone;

    public $roles;

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
    public function __construct($name, $email, $phone, $roles, $avatar, $firstName, $lastName, $middleName, ?CurrentTaskData $currentTask, $level, $stats, UserAbilities $abilities)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->roles = $roles;
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