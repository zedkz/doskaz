<?php
declare(strict_types=1);

namespace App\Blog\Posts;


use App\Blog\Image;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

final class PostsFinder
{
    const ITEMS_PER_PAGE = 10;

    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    private function initializeQuery(): QueryBuilder
    {
        return $this->connection->createQueryBuilder()
            ->addSelect('blog_posts.title')
            ->addSelect('blog_posts.annotation')
            ->addSelect('blog_posts.content')
            ->addSelect('blog_posts.slug_value as slug')
            ->addSelect('blog_categories.slug_value as "categorySlug"')
            ->addSelect('content')
            ->addSelect('image')
            ->addSelect('blog_categories.title as category_title')
            ->addSelect('blog_posts.published_at')
            ->from('blog_posts')
            ->andWhere('blog_posts.deleted_at IS NULL AND blog_posts.is_published = true')
            ->andWhere('blog_posts.published_at <= CURRENT_TIMESTAMP')
            ->join('blog_posts', 'blog_categories', 'blog_categories', 'blog_posts.category_id = blog_categories.id');
    }

    private function mapItem(array $data)
    {
        $image = $this->connection->convertToPHPValue($data['image'], Image::class);

        $imageLink = null;

        if ($image) {
            if ($image->cropData) {
                $imageLink = "/image/extract?" . http_build_query([
                        'file' => $image->image,
                        'top' => $image->cropData['y'],
                        'left' => $image->cropData['x'],
                        'areawidth' => $image->cropData['width'],
                        'areaheight' => $image->cropData['height'],
                    ]);
            }
            else {
                $imageLink = $image->image;
            }

        }

        return [
            'title' => $data['title'],
            'annotation' => $data['annotation'],
            'content' => $data['content'],
            'slug' => $data['slug'],
            'categorySlug' => $data['categorySlug'],
            'categoryTitle' => $data['category_title'],
            'publishedAt' => $this->connection->convertToPHPValue($data['published_at'], 'datetimetz_immutable'),
            'image' => $imageLink
        ];
    }

    public function find(?string $categorySlug = null, int $page = 1, int $perPage = self::ITEMS_PER_PAGE): array
    {
        $queryBuilder = $this->initializeQuery();

        if ($categorySlug) {
            $queryBuilder->andWhere('blog_categories.slug_value = :categorySlug')
                ->setParameter('categorySlug', $categorySlug);
        }

        $count = (clone $queryBuilder)->select('count(*)')->execute()->fetchColumn();

        $items = array_map(function ($item) {
            return $this->mapItem($item);
        }, $queryBuilder->setMaxResults($perPage)
            ->orderBy('published_at', 'desc')
            ->setFirstResult(($page - 1) * $perPage)->execute()->fetchAll());

        return [
            'items' => $items,
            'pages' => ceil($count / $perPage)
        ];
    }
}