<?php


namespace App\Tasks\Daily;


use Ramsey\Uuid\UuidInterface;

class DailyTaskDone
{
    /**
     * @var UuidInterface
     */
    public $id;

    /**
     * DailyTaskDone constructor.
     * @param UuidInterface $id
     */
    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }
}