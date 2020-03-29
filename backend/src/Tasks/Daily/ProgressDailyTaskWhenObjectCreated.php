<?php


namespace App\Tasks\Daily;


use App\Infrastructure\DomainEvents\EventListener;
use App\Objects\MapObjectCreated;
use App\Tasks\CurrentTaskProvider;

class ProgressDailyTaskWhenObjectCreated implements EventListener
{
    /**
     * @var DailyTaskRepository
     */
    private $dailyTaskRepository;
    /**
     * @var CurrentTaskProvider
     */
    private $currentTaskProvider;

    public function __construct(DailyTaskRepository $dailyTaskRepository, CurrentTaskProvider $currentTaskProvider)
    {
        $this->dailyTaskRepository = $dailyTaskRepository;
        $this->currentTaskProvider = $currentTaskProvider;
    }

    /**
     * @param $event MapObjectCreated
     */
    public function handle($event)
    {
        $currentTask = $this->currentTaskProvider->execute($event->createdBy);
        if ($currentTask instanceof DailyTask) {
            $this->dailyTaskRepository->forAggregate($currentTask->id(), function (DailyTask $task) use ($event) {
                $task->objectAdded($event->id);
            });
        }
    }

    public function supports($event): bool
    {
        return $event instanceof MapObjectCreated && !is_null($event->createdBy);
    }
}