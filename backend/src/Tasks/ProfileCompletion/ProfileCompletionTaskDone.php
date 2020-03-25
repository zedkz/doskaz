<?php


namespace App\Tasks\ProfileCompletion;


class ProfileCompletionTaskDone
{
    /**
     * @var integer
     */
    public $userId;

    /**
     * ProfileCompletionTaskDone constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }
}