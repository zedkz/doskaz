<?php


namespace App\Levels;


class LevelReached
{
    /**
     * @var int
     */
    public $userId;

    /**
     * @var int
     */
    public $level;

    /**
     * LevelReached constructor.
     * @param int $userId
     * @param int $level
     */
    public function __construct(int $userId, int $level)
    {
        $this->userId = $userId;
        $this->level = $level;
    }


}