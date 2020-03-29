<?php


namespace App\Tasks\Daily;


use App\Infrastructure\Doctrine\Flusher;
use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Seed extends Command
{
    protected static $defaultName = 'app:tasks:seed-daily';
    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var DailyTaskRepository
     */
    private $dailyTaskRepository;
    /**
     * @var Flusher
     */
    private $flusher;

    public function __construct(Connection $connection, DailyTaskRepository $dailyTaskRepository, Flusher $flusher)
    {
        parent::__construct();
        $this->connection = $connection;
        $this->dailyTaskRepository = $dailyTaskRepository;
        $this->flusher = $flusher;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $users = $this->connection->createQueryBuilder()
            ->select('id')
            ->from('users')
            ->andWhere('NOT EXISTS (select 1 from daily_tasks where daily_tasks.user_id = users.id)')
            ->execute()
            ->fetchAll();

        foreach ($users as $user) {
            $this->dailyTaskRepository->add(new DailyTask($user['id']));
        }
        $this->flusher->flush();

    }
}