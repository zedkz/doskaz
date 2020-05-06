<?php
declare(strict_types=1);

namespace App\Blog\Categories;

use App\Blog\Meta;
use App\Blog\MetaData;
use App\Blog\SlugFactory;
use App\Infrastructure\Doctrine\Flusher;
use Doctrine\DBAL\Connection;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\Items;
use OpenApi\Annotations\JsonContent;
use OpenApi\Annotations\Property;
use OpenApi\Annotations\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/blog/categories")
 */
final class CategoriesController extends AbstractController
{
    /**
     * @Route(methods={"GET"})
     * @param Request $request
     * @param Connection $connection
     * @return CategoryData[]
     * @Get(
     *     path="/api/blog/categories",
     *     tags={"Блог"},
     *     summary="Список категорий блога",
     *     @Response(
     *         response=200,
     *         description="",
     *         @JsonContent(
     *             type="array",
     *             @Items(
     *                 type="object",
     *                 @Property(property="id", type="integer"),
     *                 @Property(property="title", type="string")
     *             )
     *         )
     *     )
     * )
     */
    public function list(Request $request, Connection $connection): array
    {
        $qb = $connection->createQueryBuilder()->from('blog_categories')
            ->andWhere('deleted_at IS NULL');

        $items = (clone $qb)
            ->addSelect('id')
            ->addSelect('title')
            ->addSelect('slug_value as slug')
            ->orderBy('id', 'desc')
            ->execute()
            ->fetchAll();

        return array_map(function ($item) {
            $categoryData = new CategoryData();
            $categoryData->id = $item['id'];
            $categoryData->title = $item['title'];
            $categoryData->slug = $item['slug'];
            return $categoryData;
        }, $items);
    }
}
