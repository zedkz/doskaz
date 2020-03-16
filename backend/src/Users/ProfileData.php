<?php


namespace App\Users;


class ProfileData
{
    public $name;

    public $email;

    public $phone;

    public $roles;

    public $avatar;

    /**
     * ProfileData constructor.
     * @param $name
     * @param $email
     * @param $phone
     * @param $roles
     */
    public function __construct($name, $email, $phone, $roles, $avatar)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->roles = $roles;
    }
}