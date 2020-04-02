<?php


namespace App\UserEvents\BlogCommentReplied;


use App\UserEvents\Data;
use App\UserEvents\DataFormatter;
use Doctrine\DBAL\Connection;

class BlogCommentRepliedDataFormatter implements DataFormatter
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function supports(Data $data): bool
    {
        return $data instanceof BlogCommentRepliedData;
    }

    /**
     * @param Data|BlogCommentRepliedData $data
     * @return array
     */
    public function format(Data $data): array
    {
        $post = $this->connection->createQueryBuilder()
            ->select('blog_posts.slug_value as slug')
            ->addSelect('blog_categories.slug_value as "categorySlug"')
            ->addSelect('blog_posts.title')
            ->from('blog_posts')
            ->leftJoin('blog_posts', 'blog_categories', 'blog_categories', 'blog_categories.id = blog_posts.category_id')
            ->andWhere('EXISTS (SELECT 1 FROM blog_comments WHERE blog_comments.post_id = blog_posts.id AND blog_comments.id = :id)')
            ->setParameter('id', $data->commentId)
            ->execute()
            ->fetch();

        return array_merge([
            'username' => $this->connection->createQueryBuilder()
                ->select('full_name->>\'firstAndLast\'')
                ->from('users')
                ->andWhere('id = :userId')
                ->setParameter('userId', $data->userId)
                ->execute()->fetchColumn(),
        ], $post);
    }
}