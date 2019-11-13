<?php
declare(strict_types=1);

namespace App\Blog\Posts;


use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ImportBlogPosts extends Command
{
    protected static $defaultName = 'app:blogPosts:import';

    private $source;

    private $destination;

    public function __construct(Connection $source, Connection $destination)
    {
        $this->source = $source;
        $this->destination = $destination;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sourcePosts = $this->source->createQueryBuilder()
            ->addSelect('id')
            ->addSelect('title')
            ->addSelect('sef')
            ->addSelect('type_id')
            ->addSelect('date')
            ->addSelect('is_published')
            ->from('materials')
            ->execute()
            ->fetchAll();

        foreach ($sourcePosts as $sourcePost) {
            $date = $this->source->convertToPHPValue($sourcePost['date'], 'datetime');

            $this->destination->insert('blog_posts', [
                'id' => $sourcePost['id'],
                'title' => $sourcePost['title'],
                'slug_value' => $sourcePost['sef'],
                'category_id' => $sourcePost['type_id'],
                'created_at' => $this->destination->convertToDatabaseValue($date, 'datetimetz'),
                'published_at' => $this->destination->convertToDatabaseValue($date, 'datetimetz'),
                'updated_at' => $this->destination->convertToDatabaseValue($date, 'datetimetz'),
                'is_published' => $this->destination->convertToDatabaseValue($sourcePost['is_published'] == '1' ? true : false, 'boolean')
            ]);
        }
    }
}