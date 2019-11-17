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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Zend\Diactoros\Response\XmlResponse;
use Zend\Feed\Writer\Entry;
use Zend\Feed\Writer\Feed;

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
     * @Route(path="/list", methods={"GET"})
     * @param Request $request
     * @param PostsFinder $postsFinder
     * @return array
     */
    public function listPosts(Request $request, PostsFinder $postsFinder)
    {
        return $postsFinder->find($request->query->all(), $request->query->getInt('page', 1));
    }

    /**
     * @Route(path="/rss", methods={"GET"})
     * @param Request $request
     * @param PostsFinder $postsFinder
     * @return Response
     */
    public function rss(Request $request, PostsFinder $postsFinder)
    {
        $feed = new Feed();
        $feed->setTitle('Доступный Казахстан - Блог');
        $feed->setDescription('Доступный Казахстан - Блог');
        $feed->setLink($request->getSchemeAndHttpHost());

        $posts = $postsFinder->find(null);
        foreach ($posts['items'] as $post) {
            $entry = new Entry();
            $entry->setTitle($post['title']);
            $entry->setDateCreated($post['publishedAt']);
            $entry->setDescription($post['annotation']);
            $entry->setContent($post['content']);
            $entry->setLink($request->getSchemeAndHttpHost() . '/blog/' . $post['categorySlug'] . '/' . $post['slug']);
            $feed->addEntry($entry);
        }

        return new Response($feed->export('rss'), 200, ['Content-Type' => 'application/rss+xml']);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route(methods={"GET"})
     * @param Request $request
     * @return array
     */
    public function list(Request $request): array
    {
        $query = $this->connection->createQueryBuilder()
            ->from('blog_posts')
            ->leftJoin('blog_posts', 'blog_categories', 'blog_categories', 'blog_categories.id = blog_posts.category_id')
            ->andWhere('blog_posts.deleted_at IS NULL');

        if ($request->query->has('category')) {
            $query->andWhere('blog_categories.slug_value = :categorySlug')
                ->setParameter('categorySlug', $request->query->get('category'));
        }

        return [
            'items' => (clone $query)
                ->addSelect('blog_posts.id')
                ->addSelect('blog_posts.title')
                ->addSelect('blog_posts.slug_value as slug')
                ->addSelect('blog_posts.published_at')
                ->addSelect('blog_posts.is_published')
                ->addSelect('blog_posts.annotation')
                ->addSelect('blog_posts.content')
                ->addSelect('blog_posts.category_id')
                ->addSelect('blog_posts.image')
                ->addSelect('blog_posts.meta_title')
                ->addSelect('blog_posts.meta_description')
                ->addSelect('blog_posts.meta_keywords')
                ->addSelect('blog_posts.meta_og_title')
                ->addSelect('blog_posts.meta_og_description')
                ->addSelect('blog_posts.meta_og_image')
                ->addSelect('blog_categories.title as "categoryTitle"')
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
     * @IsGranted("ROLE_ADMIN")
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
     * @Route(path="/{id}", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     * @param Post $post
     */
    public function delete(Post $post)
    {
        $post->markAsDeleted();
        $this->flusher->flush();
    }

    /**
     * @Route(path="/bySlug/{categorySlug}/{postSlug}", methods={"GET"})
     * @param string $categorySlug
     * @param string $postSlug
     * @return array
     */
    public function findPostBySlug(string $categorySlug, string $postSlug)
    {
        $post = $this->connection->createQueryBuilder()
            ->select('slug_value as slug')
            ->addSelect('blog_categories.slug_value as category_slug')
            ->addSelect('title')
            ->addSelect('content')
            ->addSelect('image')
            ->addSelect('blog_categories.title as category_title')
            ->from('blog_posts')
            ->andWhere('blog_posts.deleted_at IS NULL AND blog_posts.is_published = true')
            ->andWhere('blog_posts.published_at <= CURRENT_TIMESTAMP')
            ->andWhere('slug_value = :postSlug')
            ->setParameter('postSlug', $postSlug)
            ->andwhere('blog_categories.slug_value = :categorySlug')
            ->setParameter('categorySlug', $categorySlug)
            ->join('blog_posts', 'blog_categories', 'blog_posts.category_id = blog_categories.id')
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        if (!$post) {
            throw new NotFoundHttpException();
        }

        return [
            'title' => $post['title'],
            'content' => $post['content'],
            'categoryTitle' => $post['category_title']
        ];
    }
}