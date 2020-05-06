<?php


namespace App\Tasks;


use Doctrine\DBAL\Connection;

class UserTasksFinder
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findForUser(int $userId, int $page, string $sort, int $perPage = 10): array
    {
        $query = "
               select completed_at, 'Заполните профиль' as type, 4 as points, users.created_at
                  from profile_completion_tasks
                  join users on users.id = profile_completion_tasks.user_id
                  where user_id = :userId
               union all select completed_at, 'Добавьте 1 объект' as type, reward as points, created_at from daily_tasks where user_id = :userId
               union all select completed_at, 'Верифицируйте 1 объект' as type, reward as points, created_at from daily_verification_tasks where user_id = :userId
               union all select user_administration_tasks.created_at as completed_at, administration_tasks.name as type, user_administration_tasks.points, administration_tasks.created_at from user_administration_tasks
                  join administration_tasks on user_administration_tasks.task_id = administration_tasks.id
                  where user_administration_tasks.user_id = :userId
        ";

        [$field, $sort] = explode(' ', $sort);

        $qb = $this->connection->createQueryBuilder()
            ->select(
                'completed_at as "completedAt"',
                'created_at as "createdAt"',
                'type as title',
                'points'
            )
            ->from("($query)", 'tasks')
            ->setParameter('userId', $userId);

        return [
            'pages' => (clone $qb)->select('CEIL(count(*)::FLOAT / :perPage)::INT')->setParameter('perPage', $perPage)->execute()->fetchColumn(),
            'items' => $qb->orderBy('"' . $field . '"', $sort)
                ->setMaxResults($perPage)
                ->setFirstResult(($page - 1) * $perPage)
                ->execute()
                ->fetchAll()
        ];
    }
}