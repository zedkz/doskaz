<?php


namespace App\Objects\PhotosAdding\Controller;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            'items' => array_map(fn ($item) => array_replace($item, [
                'createdAt' => $connection->convertToPHPValue($item['createdAt'], 'datetimetz_immutable')
            ]), $items),
            'count' => $query->select('COUNT(*)')->execute()->fetchColumn()
        ];
    }
}
