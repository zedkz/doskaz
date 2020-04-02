<?php


namespace App\Levels;


use App\Infrastructure\DomainEvents\EventListener;
use App\Tasks\DailyVerification\DailyVerificationTaskDone;
use App\Tasks\ProfileCompletion\ProfileCompletionTaskDone;

class IncreaseLevelOnVerificationTaskDone implements EventListener
{
    /**
     * @var LevelRepository
     */
    private $levelRepository;

    public function __construct(LevelRepository $levelRepository)
    {
        $this->levelRepository = $levelRepository;
    }

    /**
     * @param $event DailyVerificationTaskDone
     */
    public function handle($event)
    {
        $this->levelRepository->forAggregate($event->userId, function (Level $level) use ($event) {
            $level->addPoints($event->reward);
        });
    }

    public function supports($event): bool
    {
        return $event instanceof DailyVerificationTaskDone;
    }
}