<?php
declare(strict_types=1);

namespace App\Blog\Posts;


use App\Blog\Image;
use App\Blog\Meta;
use App\Blog\MetaData;
use App\Blog\SlugFactory;
use App\Infrastructure\Doctrine\Flusher;
use Doctrine\DBAL\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/blogPosts")
 */
final class PostsController extends AbstractController
{
    private $connection;

    private $flusher;

    public function __construct(Connection $connection, Flusher $flusher)
    {
        $this->connection = $connection;
        $this->flusher = $flusher;
    }

    /**
     * @Route(methods={"GET"})
     * @param Request $request
     * @return array
     */
    public function list(Request $request): array
    {
        $query = $this->connection->createQueryBuilder()
            ->from('blog_posts')
            ->andWhere('blog_posts.deleted_at IS NULL');

        return [
            'items' => (clone $query)
                ->addSelect('blog_posts.id')
                ->addSelect('blog_posts.title')
                ->addSelect('blog_categories.title as "categoryTitle"')
                ->leftJoin('blog_posts', 'blog_categories', 'blog_categories', 'blog_categories.id = blog_posts.category_id')
                ->setMaxResults($request->query->getInt('limit', 20))
                ->setFirstResult($request->query->getInt('offset', 0))
                ->addOrderBy('blog_posts.id', 'desc')
                ->execute()->fetchAll(),
            'count' => $query->select('COUNT(*)')->execute()->fetchColumn()
        ];
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route(methods={"POST"})
     * @param PostData $postData
     * @param PostRepository $postRepository
     * @param SlugFactory $slugFactory
     * @return PostData
     */
    public function create(PostData $postData, PostRepository $postRepository, SlugFactory $slugFactory)
    {
        $post = new Post($postData, $postData->image, Meta::fromMetaData($postData->meta), $slugFactory->make($postData->slug ?: $postData->title));
        $postRepository->add($post);
        $this->flusher->flush();
        return $this->retrieve($post->id());
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route(path="/{id}", methods={"PUT"})
     * @param PostData $postData
     * @param Post $post
     * @param SlugFactory $slugFactory
     * @return PostData
     */
    public function update(PostData $postData, Post $post, SlugFactory $slugFactory)
    {
        $post->update($postData, $postData->image, Meta::fromMetaData($postData->meta), $slugFactory->make($postData->slug ?: $postData->title));
        $this->flusher->flush();
        return $this->retrieve($post->id());
    }

    /**
     * @Route(path="/{id}", methods={"GET"})
     * @param $id
     * @return PostData
     */
    public function retrieve($id)
    {
        $data = $this->connection->createQueryBuilder()
            ->addSelect('id')
            ->addSelect('title')
            ->addSelect('slug_value as slug')
            ->addSelect('published_at')
            ->addSelect('is_published')
            ->addSelect('annotation')
            ->addSelect('content')
            ->addSelect('category_id')
            ->addSelect('image')
            ->addSelect('meta_title')
            ->addSelect('meta_description')
            ->addSelect('meta_keywords')
            ->addSelect('meta_og_title')
            ->addSelect('meta_og_description')
            ->addSelect('meta_og_image')
            ->from('blog_posts')
            ->andWhere('id = :id')
            ->andWhere('deleted_at IS NULL')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        if (!$data) {
            throw new NotFoundHttpException();
        }

        $postData = new PostData();
        $postData->id = $data['id'];
        $postData->title = $data['title'];
        $postData->slug = $data['slug'];
        $postData->publishedAt = $this->connection->convertToPHPValue($data['published_at'], 'datetimetz_immutable');
        $postData->isPublished = $data['is_published'];
        $postData->annotation = $data['annotation'];
        $postData->content = $data['content'];
        $postData->categoryId = $data['category_id'];
        $postData->image = $this->connection->convertToPHPValue($data['image'], Image::class);

        $meta = new MetaData();
        $meta->title = $data['meta_title'];
        $meta->description = $data['meta_description'];
        $meta->keywords = $data['meta_keywords'];
        $meta->ogTitle = $data['meta_og_title'];
        $meta->ogDescription = $data['meta_og_description'];
        $meta->ogImage = $this->connection->convertToPHPValue($data['meta_og_image'], Image::class);
        $postData->meta = $meta;

        return $postData;
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route(path="/{id}", methods={"DELETE"})
     * @param Post $post
     */
    public function delete(Post $post)
    {
        $post->markAsDeleted();
        $this->flusher->flush();
    }
}