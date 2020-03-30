<?php


namespace App\Tasks;


use Doctrine\DBAL\Connection;

class CurrentTaskDataProvider
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function forUser(int $userId): ?CurrentTaskData
    {
        $progress = $this->connection->createQueryBuilder()
            ->select([
                'progress'
            ])
            ->from('profile_completion_tasks')
            ->andWhere('user_id = :userId')
            ->setParameter('userId', $userId)
            ->execute()
            ->fetchColumn();

        if ($progress !== 100) {
            return new CurrentTaskData($progress, 'Заполните профиль');
        }

        $task = $this->connection->createQueryBuilder()
            ->select('1')
            ->from('daily_verification_tasks')
            ->andWhere('user_id = :user_id')
            ->setParameter('user_id', $userId)
            ->andWhere('completed_at is null')
            ->execute()->fetchColumn();
        if ($task) {
            return new CurrentTaskData(0, 'Верифицируйте 1 объект');
        }

        $task = $this->connection->createQueryBuilder()
            ->select('1')
            ->from('daily_tasks')
            ->andWhere('user_id = :userId')
            ->setParameter('userId', $userId)
            ->andWhere('completed_at is null')
            ->execute()
            ->fetchColumn();

        if ($task) {
            return new CurrentTaskData(0, 'Добавьте 1 объект');
        }

        return null;
    }
}