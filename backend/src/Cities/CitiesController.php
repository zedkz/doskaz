<?php


namespace App\Cities;

use Doctrine\DBAL\Connection;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use MaxMind\Db\Reader\InvalidDatabaseException;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\Items;
use OpenApi\Annotations\JsonContent;
use OpenApi\Annotations\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/cities")
 */
class CitiesController
{
    /**
     * @Route(methods={"GET"})
     * @Get(
     *     path="/api/cities",
     *     summary="Список городов",
     *     tags={"Города"},
     *     responses={
     *         @Response(
     *             response="200",
     *             description="",
     *             @JsonContent(type="array", @Items(ref="#/components/schemas/City"))
     *         )
     *     }
     * )
     * @param Connection $connection
     * @return array[]
     */
    public function index(Connection $connection)
    {
        $cities = $connection->createQueryBuilder()
            ->select([
                'id',
                'name',
                'json_build_array(json_build_array(ST_YMIN(bbox), ST_XMIN(bbox)), json_build_array(ST_YMAX(bbox), ST_XMAX(bbox))) as bounds'

            ])->from('cities')
            ->orderBy('priority', 'asc')
            ->execute()
            ->fetchAll();

        return array_map(function ($city) use ($connection) {
            return array_replace($city, [
                'bounds' => $connection->convertToPHPValue($city['bounds'], 'json')
            ]);
        }, $cities);
    }

    /**
     * @Route(path="/detect", methods={"GET"})
     * @param Request $request
     * @param Connection $connection
     * @return array
     * @throws InvalidDatabaseException
     */
    public function detect(Request $request, Connection $connection)
    {
        $dbPath = '/geoip_data/GeoLite2-City.mmdb';
        if (file_exists($dbPath)) {
            $reader = new Reader($dbPath, ['ru']);
            try {
                $record = $reader->city($request->getClientIp());

                $id = $connection->createQueryBuilder()
                    ->select('id')
                    ->from('cities_geometry')
                    ->andWhere('cities_geometry.geometry && ST_MAKEPOINT(:x, :y)')
                    ->setParameter('x', $record->location->longitude)
                    ->setParameter('y', $record->location->latitude)
                    ->execute()
                    ->fetchColumn();

                if ($id) {
                    return [
                        'id' => $id
                    ];
                }
            } catch (AddressNotFoundException | InvalidDatabaseException $exception) {
            }
        }
        return [
            'id' => $connection->createQueryBuilder()
                ->select('id')
                ->from('cities')
                ->orderBy('priority', 'asc')
                ->execute()
                ->fetchColumn()
        ];
    }
}
