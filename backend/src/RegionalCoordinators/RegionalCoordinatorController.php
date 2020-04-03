<?php


namespace App\RegionalCoordinators;


use Doctrine\DBAL\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/admin/regionalCoordinators")
 * @IsGranted("ROLE_ADMIN")
 */
class RegionalCoordinatorController extends AbstractController
{
    /**
     * @Route(methods={"GET"})
     * @param Request $request
     * @param Connection $connection
     * @return array
     */
    public function list(Request $request, Connection $connection)
    {
        $from = "
            SELECT *
            FROM regional_coordinators
            JOIN LATERAL (
                SELECT STRING_AGG(cities.name, ', ' ORDER BY name) as city_names
                FROM cities
                WHERE cities.id IN
                (SELECT JSONB_ARRAY_ELEMENTS_TEXT(cities)::INTEGER FROM regional_coordinators)
            ) cities ON TRUE
            WHERE deleted_at IS NULL
        ";

        $qb = $connection->createQueryBuilder()
            ->from("($from)", 'regional_coordinators')
            ->leftJoin('regional_coordinators', 'users', 'users', 'users.id = regional_coordinators.user_id');

        $items = (clone $qb)
            ->select([
                'regional_coordinators.user_id as id',
                'regional_coordinators.city_names as "cityNames"',
                'users.full_name->>\'firstAndLast\' as name'
            ])
            ->setMaxResults($request->query->getInt('limit', 10))
            ->setFirstResult($request->query->getInt('offset', 0))
            ->orderBy('regional_coordinators.created_at', 'desc')
            ->execute()
            ->fetchAll();

        return [
            'count' => (clone $qb)->select('count(*)')->execute()->fetchColumn(),
            'items' => $items
        ];
    }
}