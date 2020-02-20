<?php


namespace App\Objects\Adding;

use App\Infrastructure\Doctrine\Flusher;
use Doctrine\DBAL\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * @param Request $request
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

    /**
     * @Route(path="/{id}", methods={"GET"})
     * @param $id
     * @param Connection $connection
     * @return AddingRequestReviewData
     */
    public function show($id, Connection $connection)
    {
        $item = $connection->createQueryBuilder()
            ->select(['id', 'data'])
            ->from('adding_requests')
            ->andWhere('id = :id')
            ->setParameter('id', $id)
            ->execute()
            ->fetch();

        if (!$item) {
            throw new NotFoundHttpException();
        }

        return new AddingRequestReviewData(
            $item['id'],
            $connection->convertToPHPValue($item['data'], Form::class)
        );
    }

    /**
     * @Route(path="/{id}", methods={"PUT"})
     * @param AddingRequest $addingRequest
     * @param AddingRequestReviewData $addingRequestReviewData
     * @param Flusher $flusher
     */
    public function update(AddingRequest $addingRequest, AddingRequestReviewData $addingRequestReviewData, Flusher $flusher)
    {
        $addingRequest->updateData($addingRequestReviewData->form);
        $flusher->flush();
    }

    public function approve() {

    }
}