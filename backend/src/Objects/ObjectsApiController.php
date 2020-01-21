<?php
declare(strict_types=1);

namespace App\Objects;


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

        if($request->query->get('search', false)) {
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
                '*',
                'ST_X(ST_AsText(point_value)) as lat',
                'ST_Y(ST_AsText(point_value)) as long'
            ])
            ->from('objects')
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
        if($request->query->get('search', false)) {
            $q2->andWhere('TO_TSVECTOR(title) @@ websearch_to_tsquery(:search)')
                ->setParameter('search', $request->query->get('search'));
        }


        $points = $q2->execute()->fetchAll();

        $icon = "PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjIyIiBoZWlnaHQ9IjI4IiB2aWV3Qm94PSIwIDAgMjIgMjgiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik02LjE0ODY1IDE1LjcxNTZDNS43MzUzOSAxNS43MTU2IDUuNDAwMzkgMTYuMDUwNiA1LjQwMDM5IDE2LjQ2MzlWMjIuMzM3NEM1LjQwMDM5IDIyLjc1MDYgNS43MzUzOSAyMy4wODU2IDYuMTQ4NjUgMjMuMDg1NkM2LjU2MTkyIDIzLjA4NTYgNi44OTY5MiAyMi43NTA2IDYuODk2OTIgMjIuMzM3NFYxNi40NjM5QzYuODk2OTIgMTYuMDUwNiA2LjU2MTkyIDE1LjcxNTYgNi4xNDg2NSAxNS43MTU2WiIgZmlsbD0id2hpdGUiLz4KPHBhdGggZD0iTTExLjgwOTkgMTUuNzE1NkMxMS4zOTY2IDE1LjcxNTYgMTEuMDYxNiAxNi4wNTA2IDExLjA2MTYgMTYuNDYzOVYyMi4zMzc0QzExLjA2MTYgMjIuNzUwNiAxMS4zOTY2IDIzLjA4NTYgMTEuODA5OSAyMy4wODU2QzEyLjIyMzEgMjMuMDg1NiAxMi41NTgxIDIyLjc1MDYgMTIuNTU4MSAyMi4zMzc0VjE2LjQ2MzlDMTIuNTU4MSAxNi4wNTA2IDEyLjIyMzEgMTUuNzE1NiAxMS44MDk5IDE1LjcxNTZaIiBmaWxsPSJ3aGl0ZSIvPgo8cGF0aCBkPSJNMTguMzAwNCAxMC4xMDE5SDE3LjQzNDFWOS4yNTAyNkMxNy43NjY2IDguNzAwOTUgMTcuOTU4MyA4LjA1NzM3IDE3Ljk1ODMgNy4zNjk3MUMxNy45NTgzIDUuNTE2NCAxNi41NjY5IDMuOTgyMDEgMTQuNzczOSAzLjc1NjExQzE0LjQzOSAyLjA5MTE0IDEyLjk2NTEgMC44MzMzNzQgMTEuMjAzMSAwLjgzMzM3NEMxMC4xNzkgMC44MzMzNzQgOS4yMTk4NSAxLjI1ODYxIDguNTM2NzUgMS45OTQ1M0M4LjE4Njc5IDEuODg1NjYgNy44MjAyOSAxLjgyOTI0IDcuNDUzMjYgMS44MjkyNEM2LjA5MDgyIDEuODI5MjQgNC44NTIyMSAyLjYwMTQ1IDQuMjMxMDggMy43NzUxMUM0LjAzNzI4IDMuNzQzMzggMy44NDA2MyAzLjcyNzQ1IDMuNjQyMTkgMy43Mjc0NUMxLjYzMzg0IDMuNzI3NDUgMCA1LjM2MTM2IDAgNy4zNjk3MUMwIDguMDU3MzcgMC4xOTE3MDYgOC43MDA5NSAwLjUyNDIzNiA5LjI1MDI2VjIzLjAxMDRDMC41MjQyMzYgMjUuNDg2IDIuNTM4MjcgMjcuNSA1LjAxMzg0IDI3LjVIMTIuOTQ0NkMxNS4yMzAyIDI3LjUgMTcuMTIxMiAyNS43ODI3IDE3LjM5OCAyMy41NzA3SDE4LjMwMDRDMTkuOTQ5MiAyMy41NzA3IDIxLjI5MDcgMjIuMjI5MyAyMS4yOTA3IDIwLjU4MDRWMTMuMDkyM0MyMS4yOTA3IDExLjQ0MzQgMTkuOTQ5MiAxMC4xMDE5IDE4LjMwMDQgMTAuMTAxOVpNMy42NDIxOSA1LjIyMzk4QzMuOTA0ODMgNS4yMjM5OCA0LjE2MjE2IDUuMjcxMzUgNC40MDcwNyA1LjM2NDhDNC42MDI1MiA1LjQzOTQxIDQuODIwMjYgNS40Mjg3MSA1LjAwNzU1IDUuMzM1NEM1LjE5NDc3IDUuMjQyMDkgNS4zMzQ0NyA1LjA3NDYzIDUuMzkyNjEgNC44NzM3MkM1LjY1NjMgMy45NjIzMyA2LjUwMzcxIDMuMzI1NzggNy40NTMyNiAzLjMyNTc4QzcuNzk4MzYgMy4zMjU3OCA4LjEyODQyIDMuNDA1NzcgOC40MzQzOSAzLjU2MzVDOC43NzU2OCAzLjczOTM0IDkuMTk0NzEgMy42Mjg1MyA5LjQwNDIyIDMuMzA2NzdDOS44MDI2NyAyLjY5NTA2IDEwLjQ3NTEgMi4zMjk5MSAxMS4yMDMxIDIuMzI5OTFDMTIuMzgzNiAyLjMyOTkxIDEzLjM0NDQgMy4yODgyMSAxMy4zNDg4IDQuNDY3NzFDMTMuMzQ4NiA0LjQ3Mzg0IDEzLjM0ODYgNC40ODAwNSAxMy4zNDg2IDQuNDg0ODRDMTMuMzQ4NiA0LjY5MzA5IDEzLjQzNTQgNC44OTE5IDEzLjU4ODEgNS4wMzM1NUMxMy43NDA4IDUuMTc1MTIgMTMuOTQ1NCA1LjI0NjczIDE0LjE1MzIgNS4yMzEwMUMxNC4yMTU2IDUuMjI2MyAxNC4yNjg5IDUuMjIzOTggMTQuMzE2MSA1LjIyMzk4QzE1LjQ5OTIgNS4yMjM5OCAxNi40NjE4IDYuMTg2NTUgMTYuNDYxOCA3LjM2OTcxQzE2LjQ2MTggOC41NTI4NyAxNS40OTkyIDkuNTE1NDQgMTQuMzE2MSA5LjUxNTQ0SDcuOTYyOTFDNy41NDk2NCA5LjUxNTQ0IDcuMjE0NjQgOS44NTA0NCA3LjIxNDY0IDEwLjI2MzdWMTMuMDA4N0M3LjIxNDY0IDEzLjQxOTUgNi44ODA1NCAxMy43NTM2IDYuNDY5ODkgMTMuNzUzNkM2LjA1OTE3IDEzLjc1MzYgNS43MjQ5OSAxMy40MTk1IDUuNzI0OTkgMTMuMDA4N1YxMC4yNjM3QzUuNzI0OTkgOS44NTA0NCA1LjM4OTk5IDkuNTE1NDQgNC45NzY3MiA5LjUxNTQ0SDMuNjQyMTlDMi40NTkwMyA5LjUxNTQ0IDEuNDk2NTMgOC41NTI4NyAxLjQ5NjUzIDcuMzY5NzFDMS40OTY1MyA2LjE4NjU1IDIuNDU5MDMgNS4yMjM5OCAzLjY0MjE5IDUuMjIzOThaTTE1LjkzNzYgMjMuMDEwNEMxNS45Mzc2IDI0LjY2MDggMTQuNTk0OSAyNi4wMDM1IDEyLjk0NDYgMjYuMDAzNUg1LjAxMzc2QzMuMzYzMzkgMjYuMDAzNSAyLjAyMDcgMjQuNjYwOCAyLjAyMDcgMjMuMDEwNFYxMC42Mjk4QzIuNTA5MzkgMTAuODczOCAzLjA1OTgxIDExLjAxMTkgMy42NDIxMiAxMS4wMTE5SDQuMjI4NDZWMTMuMDA4N0M0LjIyODQ2IDE0LjI0NDYgNS4yMzM5OCAxNS4yNSA2LjQ2OTg5IDE1LjI1QzcuNzA1NzMgMTUuMjUgOC43MTExOCAxNC4yNDQ1IDguNzExMTggMTMuMDA4N1YxMS4wMTE5SDE0LjMxNjFDMTQuODk4NSAxMS4wMTE5IDE1LjQ0ODkgMTAuODczOCAxNS45Mzc2IDEwLjYyOThWMjMuMDEwNEgxNS45Mzc2Wk0xOS43OTQyIDIwLjU4MDRDMTkuNzk0MiAyMS40MDQxIDE5LjEyNDEgMjIuMDc0MiAxOC4zMDA1IDIyLjA3NDJIMTcuNDM0MlYxMS41OTg1SDE4LjMwMDVDMTkuMTI0MSAxMS41OTg1IDE5Ljc5NDIgMTIuMjY4NiAxOS43OTQyIDEzLjA5MjNWMjAuNTgwNFoiIGZpbGw9IndoaXRlIi8+Cjwvc3ZnPgo=";

        $pointsPrepared = array_map(function ($item) use ($icon) {
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
                            <img src='data:image/svg+xml;base64,$icon' style='max-width: 27px; max-height: 27px; z-index: 1;'/>
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


        $clusters = ['type' => 'FeatureCollection',
            'features' => array_merge($clustersPrepared, $pointsPrepared)];

        $response = new JsonResponse($clusters);
        $response->setCallback($request->query->get('callback'));
        return $response;
    }
}
