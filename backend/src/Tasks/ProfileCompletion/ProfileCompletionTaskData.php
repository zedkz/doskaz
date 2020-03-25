<?php


namespace App\Tasks\ProfileCompletion;


class ProfileCompletionTaskData
{
    private $firstName;

    private $lastName;

    private $phoneNumber;

    private $email;

    /**
     * ProfileCompletionTaskData constructor.
     * @param $firstName
     * @param $lastName
     * @param $phoneNumber
     * @param $email
     */
    public function __construct($firstName, $lastName, $phoneNumber, $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
    }

    public function toArray(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'phoneNumber' => $this->phoneNumber,
            'email' => $this->email
        ];
    }


}