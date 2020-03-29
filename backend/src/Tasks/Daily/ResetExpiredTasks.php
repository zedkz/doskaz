<?php


namespace App\Tasks\Daily;


use Doctrine\ORM\EntityManagerInterface;
use DoctrineBatchUtils\BatchProcessing\SimpleBatchIteratorAggregate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ResetExpiredTasks extends Command
{
    protected static $defaultName = 'app:tasks:reset-daily';
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $iterable = SimpleBatchIteratorAggregate::fromQuery(
            $this->entityManager->createQuery('SELECT t FROM DailyTask t where t.progress < 100'),
            100
        );

        /**
         * @var $task DailyTask
         */
        foreach ($iterable as $task) {

        }
    }

}