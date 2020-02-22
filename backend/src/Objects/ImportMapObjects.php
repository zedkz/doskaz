<?php
declare(strict_types=1);

namespace App\Objects;


use App\Infrastructure\Doctrine\Flusher;
use App\Objects\Adding\AccessibilityScore;
use App\Objects\Zone\Small\SmallFormZones;
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


        $accessibilityScoreMap = [
            0 => AccessibilityScore::notProvided(),
            1 => AccessibilityScore::fullAccessible(),
            2 => AccessibilityScore::partialAccessible(),
            3 => AccessibilityScore::notAccessible(),
            4 => AccessibilityScore::new(
                AccessibilityScore::SCORE_NOT_ACCESSIBLE,
                AccessibilityScore::SCORE_NOT_ACCESSIBLE,
                AccessibilityScore::SCORE_FULL_ACCESSIBLE,
                AccessibilityScore::SCORE_NOT_ACCESSIBLE,
                AccessibilityScore::SCORE_NOT_ACCESSIBLE
            ),
            5 => AccessibilityScore::notProvided()
        ];

        foreach ($objects as $object) {

            $zones = new SmallFormZones(
                new \App\Objects\Zone\Small\Zone($accessibilityScoreMap[(int)$object['parking']]),
                new \App\Objects\Zone\Small\Zone($accessibilityScoreMap[(int)$object['entry_group']]),
                new \App\Objects\Zone\Small\Zone($accessibilityScoreMap[(int)$object['motion_path']]),
                new \App\Objects\Zone\Small\Zone($accessibilityScoreMap[(int)$object['service_delivery_area']]),
                new \App\Objects\Zone\Small\Zone($accessibilityScoreMap[(int)$object['wc']]),
                new \App\Objects\Zone\Small\Zone($accessibilityScoreMap[(int)$object['navigation']]),
                new \App\Objects\Zone\Small\Zone(AccessibilityScore::notProvided()),
            );


            $mapObject = new MapObject(
                Point::fromLatLong($object['lat'], $object['lng']),
                $object['title'],
                (int)$object['subcategory_id'],
                $zones,
                $object['address'],
                $object['comment']
            );
            $this->mapObjectRepository->add($mapObject);
        }

        $this->flusher->flush();
    }
}