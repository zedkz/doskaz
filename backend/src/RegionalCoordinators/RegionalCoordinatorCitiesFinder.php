<?php


namespace App\RegionalCoordinators;


use Doctrine\DBAL\Connection;

class RegionalCoordinatorCitiesFinder
{
    /**
     * @var Connection
     */
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function find(int $userId): array {
        return $this->connection->createQueryBuilder()
            ->select('cities_geometry.id')
            ->from('cities')
            ->join('cities', 'cities_geometry', 'cities_geometry', 'st_intersects(cities.bbox, cities_geometry.geometry)')
            ->andWhere('cities.id in (select jsonb_array_elements_text(cities)::int from regional_coordinators where user_id = 5)')
            ->execute()
            ->fetchAll(\PDO::FETCH_COLUMN);
    }

}