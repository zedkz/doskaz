<?php


namespace App\Objects\Adding;

use App\AdminpanelPermissions\AdminpanelPermission;
use App\Infrastructure\Doctrine\Flusher;
use App\Objects\MapObjectRepository;
use Doctrine\DBAL\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/admin/addingRequests")
 * @IsGranted("ROLE_USER")
 */
class AdminController extends AbstractController
{
    /**
     * @Route(methods={"GET"})
     * @param Connection $connection
     * @param Request $request
     * @return array
     */
    public function list(Connection $connection, Request $request)
    {
        $this->denyAccessUnlessGranted(AdminpanelPermission::ADDING_REQUESTS_ACCESS);

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
            ->leftJoin('adding_requests', 'object_categories', 'object_categories', "(adding_requests.data->'first'->'categoryId')::INTEGER = object_categories.id")
            ->andWhere('adding_requests.deleted_at is null');


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
        $this->denyAccessUnlessGranted(AdminpanelPermission::ADDING_REQUESTS_ACCESS);

        $item = $connection->createQueryBuilder()
            ->select(['id', 'data', 'approved_at'])
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
            $connection->convertToPHPValue($item['data'], Form::class),
            $connection->convertToPHPValue($item['approved_at'], 'datetimetz_immutable')
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
        $this->denyAccessUnlessGranted(AdminpanelPermission::ADDING_REQUESTS_ACCESS);
        $addingRequest->updateData($addingRequestReviewData->form);
        $flusher->flush();
    }

    /**
     * @Route(path="/{id}/approve", methods={"POST"})
     * @param AddingRequest $request
     * @param MapObjectRepository $mapObjectRepository
     * @param Flusher $flusher
     */
    public function approve(AddingRequest $request, MapObjectRepository $mapObjectRepository, Flusher $flusher)
    {
        $this->denyAccessUnlessGranted(AdminpanelPermission::ADDING_REQUESTS_ACCESS);
        $mapObject = $request->approve();
        $mapObjectRepository->add($mapObject);
        $flusher->flush();
    }

    /**
     * @Route(path="/{id}", methods={"DELETE"})
     * @param AddingRequest $request
     * @param Flusher $flusher
     */
    public function delete(AddingRequest $request, Flusher $flusher)
    {
        $this->denyAccessUnlessGranted(AdminpanelPermission::ADDING_REQUESTS_ACCESS);
        $request->markAsDeleted();
        $flusher->flush();
    }
}
