<?php
declare(strict_types=1);

namespace App\Objects;


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/objects")
 */
final class ObjectsApiController extends AbstractController
{
    /**
     * @Route(path="/ymaps", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     * @throws DBALException
     */
    public function index(Request $request, Connection $connection)
    {
        $boundary = explode(',', $request->query->get('bbox'));

        $zoom = $request->query->get('zoom');

        $clusteringLevels = [
            0 => 1,
            1 => 1,
            2 => 1,
            3 => 1,
            4 => 2,
            5 => 2,
            6 => 3,
            7 => 3,
            8 => 3,
            9 => 3,
            10 => 4,
            11 => 5,
            12 => 5,
            13 => 5,
            14 => 6,
            15 => 6,
            16 => 7,
            17 => 8
        ];

        $precision = $clusteringLevels[$zoom] ?? 11;

        $query = "       
           SELECT COUNT(*) AS number,
                   ST_GEOHASH(point_value, :precision) AS hash,
                   ST_XMIN(ST_COLLECT(objects.point_value::geometry)) as p1x,
                   ST_YMIN(ST_COLLECT(objects.point_value::geometry)) as p1y,
                   ST_XMAX(ST_COLLECT(objects.point_value::geometry)) as p2x,
                   ST_YMAX(ST_COLLECT(objects.point_value::geometry)) as p2y,
                   ST_X(ST_CENTROID(ST_COLLECT(objects.point_value::geometry))) as lat,
                   st_y(ST_CENTROID(ST_COLLECT(objects.point_value::geometry))) as long
            from objects
            WHERE ST_CONTAINS(ST_MAKEENVELOPE(:x1,:y1,:x2,:y2, 4326), point_value::GEOMETRY)
            group by hash
            having count(*) > 1
        ";

        $clusters = [];

        if ($zoom < 19) {
            $clusters = $connection->executeQuery($query, [
                'x1' => $boundary[0],
                'y1' => $boundary[1],
                'x2' => $boundary[2],
                'y2' => $boundary[3],
                'precision' => $precision
            ])->fetchAll();
        }


        $ids = array_column($clusters, 'hash');

        $query2 = "
            SELECT
               *,
               ST_X(ST_AsText(point_value)) as lat,
               ST_Y(ST_AsText(point_value)) as long
            FROM objects 
            WHERE ST_CONTAINS(ST_MAKEENVELOPE(:x1,:y1,:x2,:y2, 4326), point_value::GEOMETRY)
            and st_geohash(point_value, :precision) not in (:ids)
        ";

        $points = $connection->executeQuery($query2, [
            'x1' => $boundary[0],
            'y1' => $boundary[1],
            'x2' => $boundary[2],
            'y2' => $boundary[3],
            'ids' => array_merge($ids, ['']),
            'precision' => $precision
        ], [
            'ids' => Connection::PARAM_STR_ARRAY
        ])->fetchAll();

        $pointsPrepared = array_map(function ($item) {
            return [
                'type' => 'Feature',
                'id' => $item['id'],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$item['lat'], $item['long']]
                ],
                'options' => [
                    'iconLayout' => 'default#imageWithContent',

                ],
                'properties' => [
                    'iconContent' => "
                       <div style=\"border: none; position: relative; display: flex; width: 50px; height: 61px; padding-bottom: 11px; justify-content: center; align-items: center;\"><svg width=\"50\" height=\"61\" viewBox=\"0 0 50 61\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" style=\"position: absolute; top: 0; left: 0; z-index: 0;\"><path d=\"M50 0H0V50H14.6667L25 60.3333L35.3333 50H50V0Z\" fill=\"#F8AC1A\"/></svg>
                            <img src='/bar.svg' style='max-width: 27px; max-height: 27px; z-index: 1;'/>
                       </div>
                    ",
                    "balloonContent" => "Содержимое балуна",
                    "clusterCaption" => "Метка 1",
                    "hintContent" => "Текст подсказки"
                ]
            ];
        }, $points);


        $clustersPrepared = array_map(function ($item) {
            return [
                'type' => 'Cluster',
                'id' => $item['hash'],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$item['lat'], $item['long']]
                ],
                'bbox' => [[$item['p1x'], $item['p1y']], [$item['p2x'], $item['p2y']]],
                'number' => $item['number'],
                'features' => []
            ];
        }, $clusters);


        $clusters = [
            'type' => 'FeatureCollection',
            'features' => array_merge($clustersPrepared, $pointsPrepared)
        ];

        $response = new JsonResponse($clusters);

        $response->setCallback($request->query->get('callback'));
        return $response;
    }
}