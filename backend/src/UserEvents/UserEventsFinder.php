<?php


namespace App\UserEvents;


use Doctrine\DBAL\Connection;

class UserEventsFinder
{
    private Connection $connection;

    private iterable $formatters;

    /**
     * UserEventsFinder constructor.
     * @param Connection $connection
     * @param DataFormatter[] $formatters
     */
    public function __construct(Connection $connection, $formatters)
    {
        $this->connection = $connection;
        $this->formatters = $formatters;
    }

    public function execute(int $userId, int $page, string $orderField, string $orderDirection): array
    {
        $qb = $this->connection->createQueryBuilder()
            ->select('id', 'data', 'date')
            ->from('user_events')
            ->andWhere('user_id = :userId')
            ->setParameter('userId', $userId);


        $items = (clone $qb)->orderBy($orderField, $orderDirection)
            ->setMaxResults(10)
            ->setFirstResult(($page - 1) * 10)
            ->execute()
            ->fetchAll();

        $items = array_map(function ($item) {
            $data = $this->connection->convertToPHPValue($item['data'], Data::class);

            $result = [
                'date' => $this->connection->convertToPHPValue($item['date'], 'datetimetz_immutable'),
                'type' => array_flip(Data::DISCRIMINATOR_MAP)[get_class($data)]
            ];

            foreach ($this->formatters as $formatter) {
                if ($formatter->supports($data)) {
                    $result['data'] = $formatter->format($data);
                }
            }
            return $result;
        }, $items);

        return [
            'items' => $items
        ];
    }
}