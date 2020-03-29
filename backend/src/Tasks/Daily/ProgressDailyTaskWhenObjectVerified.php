<?php


namespace App\Tasks\Daily;


use App\Infrastructure\DomainEvents\EventListener;
use App\Objects\MapObjectCreated;
use App\Objects\Verification\VerificationConfirmed;
use App\Objects\Verification\VerificationRejected;
use App\Tasks\CurrentTaskProvider;

class ProgressDailyTaskWhenObjectVerified implements EventListener
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
     * @param $event VerificationConfirmed|VerificationRejected
     */
    public function handle($event)
    {
        $currentTask = $this->currentTaskProvider->execute($event->userId);
        if ($currentTask instanceof DailyTask) {
            $this->dailyTaskRepository->forAggregate($currentTask->id(), function (DailyTask $task) use ($event) {
                $task->objectVerified($event->id);
            });
        }
    }

    public function supports($event): bool
    {
        return $event instanceof VerificationConfirmed || $event instanceof VerificationRejected;
    }
}