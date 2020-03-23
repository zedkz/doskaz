<?php


namespace App\Cities;

use Doctrine\DBAL\Connection;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\Items;
use OpenApi\Annotations\JsonContent;
use OpenApi\Annotations\Response;
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

        return  array_map(function($city) use ($connection) {
            return array_replace($city, [
                'bounds' => $connection->convertToPHPValue($city['bounds'], 'json')
            ]);
        }, $cities);
    }
}
