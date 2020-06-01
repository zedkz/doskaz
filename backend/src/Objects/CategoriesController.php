<?php


namespace App\Objects;

use Doctrine\DBAL\Connection;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\JsonContent;
use OpenApi\Annotations\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    /**
     * @Route(path="/api/objectCategories", methods={"GET"})
     * @Route(path="/api/objects/categories", methods={"GET"})
     * @param Connection $connection
     * @return array
     * @Get(
     *     path="/api/objects/categories",
     *     tags={"Объекты"},
     *     summary="Список категорий объектов",
     *     responses={
     *         @Response(
     *             response="200",
     *             description="",
     *             @JsonContent(ref="#/components/schemas/ObjectCategory")
     *         )
     *     }
     * )
     */
    public function list(Connection $connection)
    {
        $categories = $connection->createQueryBuilder()
            ->select([
                'id',
                'title',
                'icon',
                'parent_id'
            ])
            ->from('object_categories')
            ->execute()
            ->fetchAll();

        return array_map(function ($category) use ($categories) {
            return new CategoryData(
                $category['id'],
                $category['title'],
                $category['icon'],
                array_map(function ($category) {
                    return new CategoryData(
                        $category['id'],
                        $category['title'],
                        $category['icon'],
                        []
                    );
                }, array_values(array_filter($categories, function ($subCategory) use ($category) {
                    return $subCategory['parent_id'] === $category['id'];
                })))
            );
        }, array_filter($categories, function ($category) {
            return is_null($category['parent_id']);
        }));
    }
}
