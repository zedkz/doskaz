<?php


namespace App\Tasks;


class CurrentTaskData
{
    /**
     * @var int
     */
    public $progress;

    /**
     * @var string
     */
    public $title;

    /**
     * CurrentTaskData constructor.
     * @param int $progress
     * @param string $title
     */
    public function __construct(int $progress, string $title)
    {
        $this->progress = $progress;
        $this->title = $title;
    }
}