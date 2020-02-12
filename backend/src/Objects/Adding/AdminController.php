<?php


namespace App\Objects\Adding;

use Doctrine\DBAL\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/admin/addingRequests")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController
{
    /**
     * @Route(methods={"GET"})
     * @param Connection $connection
     * @return array
     */
    public function list(Connection $connection, Request $request)
    {
        $requestsQuery = $connection->createQueryBuilder()
            ->select([
                'adding_requests.id',
                "data->>'form' as form",
                "data->'first'->>'name' as name",
                "data->'first'->>'address' as address",
                'object_categories.title as category',
                'adding_requests.created_at as "createdAt"'
            ])
            ->from('adding_requests')
            ->leftJoin('adding_requests', 'object_categories', 'object_categories', "(adding_requests.data->'first'->'categoryId')::INTEGER = object_categories.id");


        $requestsData = (clone $requestsQuery)
            ->setMaxResults(20)
            ->setFirstResult($request->query->getInt('offset', 0))
            ->orderBy('id', 'desc')
            ->execute()->fetchAll();

        return [
            'count' => (clone $requestsQuery)->select('count(*)')->execute()->fetchColumn(),
            'items' => array_map(function ($request) use ($connection) {
                return array_replace($request, [
                    'createdAt' => $connection->convertToPHPValue($request['createdAt'], 'datetimetz_immutable')
                ]);
            }, $requestsData)
        ];
    }
}