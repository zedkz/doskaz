<?php


namespace App\Tasks;


use Doctrine\DBAL\Connection;

class CurrentTaskProvider
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

        if($progress === 100) {
            return null;
        }

        return new CurrentTaskData($progress, 'Заполните профиль');
    }
}