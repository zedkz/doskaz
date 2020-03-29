<?php


namespace App\Tasks\Daily;


use App\Infrastructure\Doctrine\Flusher;
use App\Infrastructure\DomainEvents\EventListener;
use App\Users\UserRegistered;

class IssueDailyTaskWhenUserRegistered implements EventListener
{
    /**
     * @var DailyTaskRepository
     */
    private $dailyTaskRepository;
    /**
     * @var Flusher
     */
    private $flusher;

    public function __construct(DailyTaskRepository $dailyTaskRepository, Flusher $flusher)
    {
        $this->dailyTaskRepository = $dailyTaskRepository;
        $this->flusher = $flusher;
    }

    /**
     * @param $event UserRegistered
     */
    public function handle($event)
    {
        $this->dailyTaskRepository->add(new DailyTask($event->id));
        $this->flusher->flush();
    }

    public function supports($event): bool
    {
        return $event instanceof UserRegistered;
    }
}