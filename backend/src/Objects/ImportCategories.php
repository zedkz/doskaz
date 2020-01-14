<?php


namespace App\Objects;


use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCategories extends Command
{
    protected static $defaultName = 'app:objects:import-categories';

    private $sourceConnection;

    private $destinationConnection;

    public function __construct(Connection $sourceConnection, Connection $destinationConnection)
    {
        $this->sourceConnection = $sourceConnection;
        $this->destinationConnection = $destinationConnection;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $count = $this->destinationConnection->executeQuery('SELECT COUNT(*) FROM object_categories')->fetchColumn();
        if ($count > 0) {
            return;
        }

        $data = $this->sourceConnection->createQueryBuilder()
            ->select('*')->from('categories')
            ->execute()->fetchAll();

        foreach ($data as $category) {
            $this->destinationConnection->insert('object_categories', [
                'id' => $category['id'],
                'title' => $category['title_ru'],
                'parent_id' => $category['parent_id'],
                'icon' => $category['icon']
            ]);
        }

        $this->destinationConnection->exec('SELECT setval(\'object_categories_id_seq\', (select max(id) from object_categories), true)');
    }
}