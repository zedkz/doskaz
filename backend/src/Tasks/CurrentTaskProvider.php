<?php


namespace App\Tasks;


use App\Tasks\Daily\DailyTaskRepository;
use App\Tasks\ProfileCompletion\ProfileCompletionTaskRepository;


class CurrentTaskProvider
{
    /**
     * @var DailyTaskRepository
     */
    private $dailyTaskRepository;
    /**
     * @var ProfileCompletionTaskRepository
     */
    private $profileCompletionTaskRepository;

    public function __construct(DailyTaskRepository $dailyTaskRepository, ProfileCompletionTaskRepository $profileCompletionTaskRepository)
    {
        $this->dailyTaskRepository = $dailyTaskRepository;
        $this->profileCompletionTaskRepository = $profileCompletionTaskRepository;
    }

    public function execute(int $userId)
    {
        $profileCompletionTask = $this->profileCompletionTaskRepository->find($userId);
        if (!$profileCompletionTask->isCompleted()) {
            return $profileCompletionTask;
        }

        $dailyTask = $this->dailyTaskRepository->findLastByUserId($userId);
        return $dailyTask;
    }
}