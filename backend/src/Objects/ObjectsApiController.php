<?php
declare(strict_types=1);

namespace App\Objects;


use App\Objects\Adding\AccessibilityScore;
use Doctrine\DBAL\Connection;
use OpenApi\Annotations\ExternalDocumentation;
use OpenApi\Annotations\Get;
use OpenApi\Annotations\Items;
use OpenApi\Annotations\Parameter;
use OpenApi\Annotations\Response;
use OpenApi\Annotations\Schema;
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
     * @param Connection $connection
     * @return JsonResponse
     *
     * @Get(
     *     path="/api/objects/ymaps",
     *     summary="Объекты для яндекс-карты",
     *     tags={"Объекты"},
     *     @ExternalDocumentation(url="https://tech.yandex.ru/maps/jsapi/doc/2.1/dg/concepts/remote-object-manager/backend-docpage/"),
     *     @Parameter(name="zoom", in="query", required=true, description="Масштаб", @Schema(type="integer"), example=14),
     *     @Parameter(name="bbox", in="query", required=true, description="Массив географических координат углов", @Schema(type="string"), example="52.2523,76.8384,52.3332,77.1021"),
     *     @Parameter(name="categories", in="query", description="Категории", style="deepObject", @Schema(type="array", @Items(type="integer"))),
     *     @Parameter(name="search", in="query", description="Поисковой запрос", @Schema(type="string")),
     *     @Response(response="200", description="")
     * )
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

        $q1 = $connection->createQueryBuilder()
            ->select([
                'COUNT(*) AS number',
                'ST_GEOHASH(point_value, :precision) AS hash',
                'ST_XMIN(ST_COLLECT(objects.point_value::GEOMETRY)) AS p1x',
                'ST_YMIN(ST_COLLECT(objects.point_value::GEOMETRY)) AS p1y',
                'ST_XMAX(ST_COLLECT(objects.point_value::GEOMETRY)) AS p2x',
                'ST_YMAX(ST_COLLECT(objects.point_value::GEOMETRY)) AS p2y',
                'ST_X(ST_CENTROID(ST_COLLECT(objects.point_value::GEOMETRY))) AS lat',
                'ST_Y(ST_CENTROID(ST_COLLECT(objects.point_value::GEOMETRY))) AS long'
            ])
            ->from('objects')
            ->andWhere('ST_CONTAINS(ST_MAKEENVELOPE(:x1,:y1,:x2,:y2, 4326), point_value::GEOMETRY)')
            ->groupBy('hash')
            ->having('COUNT(*) > 1')
            ->setParameters([
                'x1' => $boundary[0],
                'y1' => $boundary[1],
                'x2' => $boundary[2],
                'y2' => $boundary[3],
                'precision' => $precision
            ]);

        $categories = $request->query->get('categories', []);
        if (count($categories)) {
            $q1->andWhere('category_id IN (:categories)')
                ->setParameter('categories', $categories, Connection::PARAM_STR_ARRAY);
        }

        if ($request->query->get('search', false)) {
            $q1->andWhere('TO_TSVECTOR(title) @@ WEBSEARCH_TO_TSQUERY(:search)')
                ->setParameter('search', $request->query->get('search'));
        }

        $clusters = [];

        if ($zoom < 19) {
            $clusters = $q1->execute()->fetchAll();
        }

        $ids = array_column($clusters, 'hash');

        $q2 = $connection->createQueryBuilder()
            ->select([
                'objects.id',
                'categories.icon',
                'overall_score_movement',
                'ST_X(ST_AsText(point_value)) as lat',
                'ST_Y(ST_AsText(point_value)) as long',
            ])
            ->from('objects')
            ->leftJoin('objects', 'object_categories', 'categories', 'categories.id = objects.category_id')
            ->andWhere('ST_CONTAINS(ST_MAKEENVELOPE(:x1,:y1,:x2,:y2, 4326), point_value::GEOMETRY)')
            ->andWhere('ST_GEOHASH(point_value, :precision) NOT IN (:ids)')
            ->setParameters([
                'x1' => $boundary[0],
                'y1' => $boundary[1],
                'x2' => $boundary[2],
                'y2' => $boundary[3],
                'ids' => array_merge($ids, ['']),
                'precision' => $precision
            ], [
                'ids' => Connection::PARAM_STR_ARRAY
            ]);

        if (count($categories)) {
            $q2->andWhere('category_id IN (:categories)')
                ->setParameter('categories', $categories, Connection::PARAM_STR_ARRAY);
        }
        if ($request->query->get('search', false)) {
            $q2->andWhere('TO_TSVECTOR(title) @@ websearch_to_tsquery(:search)')
                ->setParameter('search', $request->query->get('search'));
        }
        $points = $q2->execute()->fetchAll();
        $pointsPrepared = array_map(function ($item) {
            $colors = [
                AccessibilityScore::SCORE_PARTIAL_ACCESSIBLE => '#F8AC1A',
                AccessibilityScore::SCORE_NOT_ACCESSIBLE => '#DE1220',
                AccessibilityScore::SCORE_NOT_PROVIDED => 'grey',
                AccessibilityScore::SCORE_FULL_ACCESSIBLE => '#3DBA3B'
            ];

            return [
                'type' => 'Feature',
                'id' => $item['id'],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$item['lat'], $item['long']]
                ],
                'options' => [
                    'iconLayout' => 'custom#objectIconLayout',
                    'iconShape' => [
                        'type' => 'Rectangle',
                        'coordinates' => [
                            [-25, -60], [25, 0]
                        ]
                    ]
                ],
                'properties' => [
                    'color' => $colors[$item['overall_score_movement']],
                    'icon' => $item['icon'],
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


        $clusters = ['type' => 'FeatureCollection',
            'features' => array_merge($clustersPrepared, $pointsPrepared)];

        $response = new JsonResponse($clusters);
        $response->setCallback($request->query->get('callback'));
        return $response;
    }
}
