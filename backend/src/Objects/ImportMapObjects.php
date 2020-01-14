<?php
declare(strict_types=1);

namespace App\Objects;


use App\Infrastructure\Doctrine\Flusher;
use Doctrine\Common\Persistence\ConnectionRegistry;
use Doctrine\DBAL\Connection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function GuzzleHttp\Psr7\str;

final class ImportMapObjects extends Command
{
    protected static $defaultName = 'app:objects:import';

    private $mapObjectRepository;

    private $flusher;

    private $connection;

    public function __construct(MapObjectRepository $mapObjectRepository, Flusher $flusher, Connection $connection)
    {
        $this->mapObjectRepository = $mapObjectRepository;
        $this->connection = $connection;
        $this->flusher = $flusher;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $objects = $this->connection->createQueryBuilder()->select('*')->from('objects')
            ->andWhere('objects.lat != \'\'')
            ->execute()->fetchAll();

        foreach ($objects as $object) {
            $mapObject = new MapObject(Point::fromLatLong($object['lat'], $object['lng']), (int) $object['subcategory_id']);
            $this->mapObjectRepository->add($mapObject);
        }

        $this->flusher->flush();
    }
}