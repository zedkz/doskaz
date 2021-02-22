<?php


namespace App\Objects\PhotosAdding\Controller;

use App\Infrastructure\Doctrine\Flusher;
use App\Infrastructure\FileReferenceCollection;
use App\Objects\PhotosAdding\Entity\PhotosAddingRequest;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/admin/photosAdding")
 * @IsGranted("ROLE_ADMIN")
 */
class PhotosAddingAdminController extends AbstractController
{
    /**
     * @Route(methods={"GET"})
     * @param Request $request
     * @param Connection $connection
     * @return array
     * @throws Exception
     */
    public function list(Request $request, Connection $connection): array
    {
        $query = $connection->createQueryBuilder()
            ->from('object_photos_adding_requests', 'r')
            ->andWhere("r.status != 'approved'");

        $items = (clone $query)
            ->addSelect('r.id')
            ->addSelect('r.object_id as "objectId"')
            ->addSelect('o.title as object')
            ->addSelect('r.created_at as "createdAt"')
            ->leftJoin('r', 'objects', 'o', 'o.id = r.object_id')
            ->setMaxResults($request->query->getInt('limit', 20))
            ->setFirstResult($request->query->getInt('offset', 0))
            ->addOrderBy('r.id', 'desc')
            ->execute()->fetchAll();

        return [
            'items' => array_map(fn($item) => array_replace($item, [
                'createdAt' => $connection->convertToPHPValue($item['createdAt'], 'datetimetz_immutable')
            ]), $items),
            'count' => $query->select('COUNT(*)')->execute()->fetchColumn()
        ];
    }

    /**
     * @Route(path="/{id}", methods={"GET"})
     * @param $id
     * @param Connection $connection
     * @return mixed
     * @throws Exception
     */
    public function retrieve($id, Connection $connection)
    {
        $item = $connection->createQueryBuilder()
            ->addSelect('id')
            ->addSelect('status')
            ->addSelect('photos')
            ->from('object_photos_adding_requests')
            ->where('id = :id')
            ->setParameter('id', $id)
            ->execute()
            ->fetch();

        if (!$item) {
            throw new NotFoundHttpException();
        }

        return array_replace($item, [
            'photos' => $connection->convertToPHPValue($item['photos'], FileReferenceCollection::class)
        ]);
    }

    /**
     * @Route(path="/{item}/approve", methods={"POST"})
     * @param PhotosAddingRequest $item
     * @param EntityManagerInterface $entityManager
     */
    public function approve(PhotosAddingRequest $item, EntityManagerInterface $entityManager)
    {
        $entityManager->transactional(function () use ($item) {
            $item->approve($this->getUser()->id());
        });
    }
}
