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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     *     @Parameter(name="accessibilityLevel", in="query", description="Уровень доступности", @Schema(type="string", enum={"full_accessiblie", "partial_accessible", "not_accessible"})),
     *     @Response(response="200", description="")
     * )
     */
    public function index(Request $request, Connection $connection)
    {
        $boundary = explode(',', $request->query->get('bbox'));

        $zoom = $request->query->get('zoom');

        $accessibilityLevels = $request->query->get('accessibilityLevels', []);

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
            ->andWhere('objects.deleted_at IS NULL')
            ->groupBy('hash')
            ->having('COUNT(*) > 1')
            ->setParameters([
                'x1' => $boundary[0],
                'y1' => $boundary[1],
                'x2' => $boundary[2],
                'y2' => $boundary[3],
                'precision' => $precision
            ]);


        if (count($accessibilityLevels)) {
            $q1->andWhere('overall_score_movement IN (:levels)')
                ->setParameter('levels', $accessibilityLevels, Connection::PARAM_STR_ARRAY);
        }

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
            ->andWhere('objects.deleted_at IS NULL')
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

        if (count($accessibilityLevels)) {
            $q2->andWhere('overall_score_movement IN (:levels)')
                ->setParameter('levels', $accessibilityLevels, Connection::PARAM_STR_ARRAY);
        }

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
                AccessibilityScore::SCORE_NOT_PROVIDED => '#7B95A7',
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

    /**
     * @Route(path="/{id}", requirements={"id" = "\d+"}, methods={"GET"})
     * @param $id
     * @param Connection $connection
     * @return array|NotFoundHttpException
     */
    public function object($id, Connection $connection)
    {
        $object = $connection->createQueryBuilder()
            ->select([
                'objects.title',
                'objects.address',
                'objects.description',
                'objects.overall_score_movement',
                'objects.overall_score_limb',
                'objects.overall_score_vision',
                'objects.overall_score_hearing',
                'objects.overall_score_intellectual',
                'objects.zones',
                'ST_X(ST_AsText(objects.point_value)) as lat',
                'ST_Y(ST_AsText(objects.point_value)) as long',
                'sub_categories.title as sub_category',
                'sub_categories.icon as sub_category_icon',
                'object_categories.title as category',
                'object_categories.icon as category_icon',
            ])
            ->from('objects')
            ->leftJoin('objects', 'object_categories', 'sub_categories', 'sub_categories.id = objects.category_id')
            ->leftJoin('sub_categories', 'object_categories', 'object_categories', 'sub_categories.parent_id = object_categories.id')
            ->andWhere('objects.id = :id')
            ->andWhere('objects.deleted_at IS NULL')
            ->setParameter('id', $id)
            ->execute()
            ->fetch();

        if (!$object) {
            return new NotFoundHttpException();
        }

        /**
         * @var Zones
         */
        $zones = $connection->convertToPHPValue($object['zones'], Zones::class);

        $scoresByZone = [
            'parking' => $zones->parking->accessibilityScore(),
            'entrance' => AccessibilityScore::average(...[
                $zones->entrance1->accessibilityScore(),
                $zones->entrance2 ? $zones->entrance2->accessibilityScore() : null,
                $zones->entrance3 ? $zones->entrance3->accessibilityScore() : null,
            ]),
            'movement' => $zones->movement->accessibilityScore(),
            'service' => $zones->service->accessibilityScore(),
            'toilet' => $zones->toilet->accessibilityScore(),
            'navigation' => $zones->navigation->accessibilityScore(),
            'serviceAccessibility' => $zones->serviceAccessibility->accessibilityScore(),
        ];


        return [
            'title' => $object['title'],
            'address' => $object['address'],
            'description' => strip_tags($object['description']),
            'subCategory' => $object['sub_category'],
            'category' => $object['category'],
            'coordinates' => [
                (float)$object['lat'], (float)$object['long']
            ],
            'overallScore' => $object['overall_score_movement'],
            'scoreByZones' => array_map(function (AccessibilityScore $accessibilityScore) {
                return $accessibilityScore->movement;
            }, $scoresByZone),
            'icon' => $object['sub_category_icon'] ? $object['sub_category_icon'] : $object['category_icon'],
        ];
    }


    /**
     * @Route(path="/attributes", methods={"GET"})
     */
    public function attributes()
    {
        return [
            'middle' => [
                'parking' => [
                    [
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 1, 'title' => 'Количество парковочных мест', 'subTitle' => 'Не менее одного на 25 мест'],
                                    ['key' => 2, 'title' => 'Размер парковки', 'subTitle' => 'Не менее 3,66 х 5,38 м'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Обозначение автостоянки для инвалидов',
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 3, 'title' => 'Знак на плоскости стоянки'],
                                    ['key' => 4, 'title' => 'Знак на вертикальной поверхности (стене, столбе, стойке)'],
                                    ['key' => 5, 'title' => 'Знак 5.15 «Место стоянки»'],
                                    ['key' => 6, 'title' => 'Знак 7.15 «Инвалиды»'],
                                    ['key' => 7, 'title' => 'Стрелка и расстояние'],
                                    ['key' => 8, 'title' => 'Разметка на плоскости'],
                                    ['key' => 9, 'title' => 'Съезд с тротуара на парковку', 'subTitle' => 'Рекомендуется ширина 1,5 м'],
                                    ['key' => 10, 'title' => 'Расстояние до входа в здание', 'subTitle' => 'Для общественных зданий менее 50 м'],
                                ]
                            ]
                        ]
                    ]
                ],
                'entrance' => [
                    [
                        'subGroups' => [
                            [
                                'attributes' => [
                                    [
                                        'key' => 1, 'title' => 'Вход на уровне земли'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Лестница наружная',
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 2, 'title' => 'Предупреждающая полоса', 'subTitle' => 'Тактильная за 30-40 см до первой и последней ступени марша шириной не менее 56 см, контрастная шириной 30 см'],
                                    ['key' => 3, 'title' => 'Ширина проступей лестниц не менее 40 см'],
                                    ['key' => 4, 'title' => 'Высота подъема ступеней не более 12 см'],
                                    ['key' => 5, 'title' => 'Количество ступеней', 'subTitle' => 'В одном марше от 3 до 12, одиночные ступени недопустимы'],
                                    ['key' => 6, 'title' => 'Ширина марша лестниц не менее 1,35 м'],
                                ]
                            ],
                            [
                                'title' => 'Поручни перил при перепадах высот более 0,45 м',
                                'attributes' => [
                                    ['key' => 7, 'subTitle' => 'Вдоль обеих сторон'],
                                    ['key' => 8, 'subTitle' => 'На высоте 0,9 м для взрослых, 0,5 м для детей'],
                                    ['key' => 9, 'subTitle' => 'Горизонтальный закругленный вылет после последней опоры 30 см'],
                                    ['key' => 10, 'subTitle' => 'При ширине лестничного марша более 2,5 м — разделительные поручни'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Пандус наружный',
                        'subGroups' => [
                            [
                                'title' => 'Покрытие пандуса',
                                'attributes' => [
                                    ['key' => 11, 'subTitle' => 'Твёрдые материалы'],
                                    ['key' => 12, 'subTitle' => 'Без зазоров'],
                                    ['key' => 13, 'subTitle' => 'Без вибрации при движении'],
                                    ['key' => 14, 'subTitle' => 'Предотвращающее скольжение'],
                                    ['key' => 15, 'title' => 'Ширина марша не менее 1,2 м'],
                                    ['key' => 16, 'title' => 'Разворотные горизонтальные площадки', 'subTitle' => 'Размеры 1,2 х 1,5 м'],
                                    ['key' => 17, 'title' => 'Высота марша 40-45 см'],
                                    ['key' => 18, 'title' => 'Уклон', 'subTitle' => 'При высоте подъёма выше 20 см — 1 : 20 (5% или 2,9°) При высоте подъёма до 20 см — 1 : 10 (10% или 5,7°)'],
                                    ['key' => 19, 'title' => 'Бортики не менее 5 см'],
                                ]
                            ],
                            [
                                'title' => 'Поручни перил при перепадах высот более 0,45 м',
                                'attributes' => [
                                    ['key' => 20, 'subTitle' => 'Вдоль обеих сторон'],
                                    ['key' => 21, 'subTitle' => 'На высоте 0,7-0,9 м для взрослых, 0,5 м для детей'],
                                    ['key' => 22, 'subTitle' => 'Горизонтальный закругленный вылет после последней опоры 30 см'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Подъёмник наружный электрический',
                        'subGroups' => [
                            [
                                'title' => 'Стационарные подъёмники',
                                'attributes' => [
                                    ['key' => 23, 'subTitle' => 'Параметры не менее 0,9 х 1,2 м'],
                                    ['key' => 24, 'subTitle' => 'Жёсткое ограждение со всех сторон'],
                                    ['key' => 25, 'subTitle' => 'Бортики'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Входная площадка, входная дверь, тамбур',
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 26, 'title' => 'Входная площадка с пандусом', 'subTitle' => 'Размеры не менее 2,2 х 2,2 м'],
                                ]
                            ],
                            [
                                'title' => 'Глубина пространства перед дверью',
                                'attributes' => [
                                    ['key' => 27, 'subTitle' => 'При открывании «от себя» — не менее 1,2 м'],
                                    ['key' => 28, 'subTitle' => 'При открывании «к себе» — не менее 1,5 м'],
                                ]
                            ],
                            [
                                'title' => 'Входная дверь',
                                'attributes' => [
                                    ['key' => 29, 'subTitle' => 'Открытие в противоположную сторону от пандуса'],
                                    ['key' => 30, 'subTitle' => 'Ширина в свету не менее 90 см'],
                                    ['key' => 31, 'subTitle' => 'Пороги не выше 1,4 см'],
                                ]
                            ],
                            [
                                'title' => 'Стеклянная дверь',
                                'attributes' => [
                                    ['key' => 32, 'subTitle' => 'Наличие предупреждения для слабовидящих на стеклянной двери'],
                                    ['key' => 33, 'subTitle' => 'Прямоугольник 10 х 20 см²'],
                                    ['key' => 34, 'subTitle' => 'Цвет яркий (контрастный)'],
                                    ['key' => 35, 'subTitle' => 'На высоте не ниже 1,2 м и не выше 1,5 м'],
                                ]
                            ],
                            [
                                'title' => 'Тамбуры',
                                'attributes' => [
                                    ['key' => 36, 'subTitle' => '1,5-1,8 м (глубина) х 2 м (ширина)'],
                                    ['key' => 37, 'subTitle' => '2,3 м (глубина) х  1,5 м (ширина)'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Ситуационная помощь на входе',
                        'subGroups' => [
                            [
                                'title' => 'Кнопка вызова персонала',
                                'attributes' => [
                                    ['key' => 38, 'subTitle' => 'Доступность, высота 85 см  – 1 м'],
                                    ['key' => 39, 'subTitle' => 'Навес от осадков'],
                                    ['key' => 40, 'subTitle' => 'Шрифт Брайля'],
                                ]
                            ]
                        ]
                    ]
                ],
                'movement' => [
                    [
                        'title' => 'Территория пути передвижения',
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 1, 'title' => 'Ширина коридора 1,5 м']
                                ]
                            ],
                            [
                                'title' => 'Покрытие пола',
                                'attributes' => [
                                    ['key' => 2, 'subTitle' => 'Твёрдые материалы'],
                                    ['key' => 3, 'subTitle' => 'Без зазоров'],
                                    ['key' => 4, 'subTitle' => 'Без вибрации при движении'],
                                    ['key' => 5, 'subTitle' => 'Предотвращающее скольжение'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Двери внутренние',
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 6, 'title' => 'Ширина дверей не менее 90 см'],
                                    ['key' => 7, 'title' => 'Высота порогов не более 1,4 см']
                                ]
                            ],
                            [
                                'title' => 'Стеклянная дверь',
                                'attributes' => [
                                    ['key' => 8, 'subTitle' => 'Наличие предупреждения для слабовидящих на стеклянной двери'],
                                    ['key' => 9, 'subTitle' => 'Прямоугольник 10 х 20 см²'],
                                    ['key' => 10, 'subTitle' => 'Цвет яркий (контрастный)'],
                                    ['key' => 11, 'subTitle' => 'На высоте не ниже 1,2 м и не выше 1,5 м'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Лестницы внутренние',
                        'subGroups' => [
                            [
                                'title' => 'Рифление и контрастные полосы на ступенях лестниц (верхняя и нижняя ступени в каждом марше)',
                                'attributes' => [
                                    ['key' => 12, 'subTitle' => 'Контрастный цвет'],
                                    ['key' => 13, 'subTitle' => 'Тактильные указатели'],
                                    ['key' => 14, 'subTitle' => 'Ширина полосы 30 см'],
                                    ['key' => 15, 'title' => 'Ширина марша лестниц не менее 1,35 м'],
                                    ['key' => 16, 'title' => 'Ширина проступей лестниц не менее 30 см'],
                                    ['key' => 17, 'title' => 'Высота подъема ступеней не более 15 см'],
                                    ['key' => 18, 'title' => 'Максимальное число ступеней на пролет', 'subTitle' => 'В одном марше от 3 до 12, одиночные ступени недопустимы'],
                                ]
                            ],
                            [
                                'title' => 'Поручни перил при перепадах высот более 0,45 м',
                                'attributes' => [
                                    ['key' => 19, 'subTitle' => 'Вдоль обеих сторон'],
                                    ['key' => 20, 'subTitle' => 'На высоте 0,9 м для взрослых, 0,5 м для детей'],
                                    ['key' => 21, 'subTitle' => 'Горизонтальный закругленный вылет после последней опоры 30 см'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Пандусы внутренние',
                        'subGroups' => [
                            [
                                'title' => 'Покрытие пандуса',
                                'attributes' => [
                                    ['key' => 22, 'subTitle' => 'Твёрдые материалы'],
                                    ['key' => 23, 'subTitle' => 'Без зазоров'],
                                    ['key' => 24, 'subTitle' => 'Без вибрации при движении'],
                                    ['key' => 25, 'subTitle' => 'Предотвращающее скольжение'],
                                    ['key' => 26, 'title' => 'Разворотные горизонтальные площадки', 'subTitle' => 'Размеры 1,2 х 1,5 м'],
                                ]
                            ],
                            [
                                'title' => 'Поручни перил при перепадах высот более 0,45 м',
                                'attributes' => [
                                    ['key' => 27, 'subTitle' => 'Вдоль обеих сторон'],
                                    ['key' => 28, 'subTitle' => 'На высоте 0,7-0,9 м для взрослых, 0,5 м для детей'],
                                    ['key' => 29, 'subTitle' => 'Горизонтальный закругленный вылет после последней опоры 30 см'],
                                    ['key' => 30, 'title' => 'Ширина марша не менее 1,2 м'],
                                    ['key' => 31, 'title' => 'Высота марша 40-45 см'],
                                    ['key' => 32, 'title' => 'Уклон', 'subTitle' => 'При высоте подъёма выше 20 см — 1 : 20 (5% или 2,9°)'],
                                    ['key' => 33, 'title' => 'Бортики не менее 5 см'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Лифты и электрические подъемники внутренние',
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 34, 'title' => 'Габариты кабины лифта', 'subTitle' => 'Не менее 1,3 х 2,1 м'],
                                    ['key' => 35, 'title' => 'Ширина двери в кабину не менее 90 см'],
                                ]
                            ],
                            [
                                'title' => 'Информация для людей, имеющих проблемы со зрением',
                                'attributes' => [
                                    ['key' => 36, 'subTitle' => 'Надписи, выполненные шрифтом Брайля на кнопках'],
                                    ['key' => 37, 'subTitle' => 'Не сенсорные кнопки']
                                ]
                            ]
                        ]
                    ]
                ],
                'service' => [
                    [
                        'subGroups' => [
                            [
                                'title' => 'Размеры рабочей поверхности стола, стойки',
                                'attributes' => [
                                    ['key' => 1, 'subTitle' => 'Высота не более 80 см от уровня пола'],
                                    ['key' => 2, 'subTitle' => 'Коленное пространство не менее 70 см'],
                                    ['key' => 3, 'title' => 'Опознавательные таблички', 'subTitle' => 'Высота размещения от 1,4 м до 1,6 м']
                                ]
                            ],
                            [
                                'title' => 'Зона досягаемости для людей на кресло-колясках',
                                'attributes' => [
                                    ['key' => 4, 'subTitle' => 'При расположении сбоку от посетителя — не выше 1,4 м и не ниже 0,3 от уровня пола'],
                                    ['key' => 5, 'subTitle' => 'При фронтальном подходе — не выше 1,2 м и не ниже 0,4 м от уровня пола']
                                ]
                            ]
                        ]
                    ]
                ],
                'toilet' => [
                    [
                        'subGroups' => [
                            [
                                'title' => 'Наличие уборной',
                                'attributes' => [
                                    ['key' => 1, 'subTitle' => 'Расчётная численность посетителей более 50 человек'],
                                    ['key' => 2, 'subTitle' => 'Продолжительности нахождения в здании более 60 минут']
                                ]
                            ],
                            [
                                'title' => 'Дверь в уборную',
                                'attributes' => [
                                    ['key' => 3, 'subTitle' => 'Дверь открывается наружу'],
                                    ['key' => 4, 'subTitle' => 'Снаружи размещена криптограмма'],
                                    ['key' => 5, 'subTitle' => 'Ширина двери не менее 1,2 м'],
                                    ['key' => 6, 'subTitle' => 'Поручни на внутренней стороне двери длиной не менее 60 см'],
                                    ['key' => 7, 'subTitle' => 'Высота порогов не более 1,4 см'],
                                    ['key' => 8, 'title' => 'Размеры универсальной кабины не менее 1,65 х 2,0 м'],
                                ]
                            ],
                            [
                                'title' => 'Другое оборудование',
                                'attributes' => [
                                    ['key' => 9, 'subTitle' => 'Крючки для одежды'],
                                    ['key' => 10, 'subTitle' => 'Крючки для костылей'],
                                    ['key' => 11, 'subTitle' => 'Крючки для других принадлежностей'],
                                    ['key' => 12, 'subTitle' => 'Зеркало'],
                                    ['key' => 13, 'subTitle' => 'Дозатор с мылом'],
                                    ['key' => 14, 'subTitle' => 'Диспенсер для туалетной бумаги и салфеток'],
                                    ['key' => 15, 'subTitle' => 'Электрическая сушилка для рук'],
                                    ['key' => 16, 'subTitle' => 'Урна'],
                                    ['key' => 17, 'subTitle' => 'Открывающиеся части предметов на высоте от 1,0 до 1,2 м'],
                                ]
                            ],
                            [
                                'title' => 'Кнопка вызова SOS',
                                'attributes' => [
                                    ['key' => 18, 'subTitle' => 'На высоте от 40 см до 60 см над уровнем пола'],
                                    ['key' => 19, 'subTitle' => 'На расстоянии от края унитаза от 15 см до 30 см'],
                                    ['key' => 20, 'subTitle' => 'Указатель «Кнопка экстренного вызова»'],
                                ]
                            ]
                        ]
                    ]
                ],
                'navigation' => [
                    [
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 1, 'title' => 'Указатели и информационный материал', 'subTitle' => 'Контрастные крупные буквы, выделенные жирным шрифтом'],
                                    ['key' => 2, 'title' => 'Форматы информации', 'subTitle' => 'Шрифт Брайля, аудио-версия, радиомаяки, радиометки, радиоинформаторы'],
                                    ['key' => 3, 'title' => 'Знаки и символы', 'subTitle' => 'Международные знаки и символы на контрастном фоне'],
                                    ['key' => 4, 'title' => 'Форматы информации', 'subTitle' => 'Визуальные, тактильные, звуковые, световые указатели, табло и пиктограммы, а также контрастное цветовое решение элементов интерьера, переводчик с жестового языка'],
                                ]
                            ],
                            [
                                'title' => 'Тактильная информация',
                                'attributes' => [
                                    ['key' => 5, 'subTitle' => 'Рельефные тактильные обозначения путей движения'],
                                    ['key' => 6, 'subTitle' => 'Непрерывные тактильные обозначения путей движения'],
                                    ['key' => 7, 'title' => 'Мнемосхема', 'subTitle' => 'Размещение с правой стороны на расстоянии от 3 м до 5 м от входа в объект'],
                                ]
                            ]
                        ]
                    ]
                ],
                'serviceAccessibility' => [
                    [
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 1, 'title' => 'Универсальный проект', 'subTitle' => 'Услуга оказывается во всем здании'],
                                    ['key' => 2, 'title' => 'Разумное приспособление', 'subTitle' => 'Услуга оказывается на 1 этаже'],
                                    ['key' => 3, 'title' => 'Есть доставка товаров или вызов специалиста на дом ', 'subTitle' => 'Услуга оказывается дистанционно'],
                                    ['key' => 4, 'title' => 'Кнопка вызова персонала ', 'subTitle' => ''],
                                    ['key' => 5, 'title' => 'Оказание ситуационной помощи со стороны персонала ', 'subTitle' => ''],
                                    ['key' => 6, 'title' => 'Протоколы/инструкции по коммуникации и оказанию помощи маломобильным гражданам', 'subTitle' => 'Был ли обучен персонал'],
                                    ['key' => 7, 'title' => 'Льготы для людей с инвалидностью 1, 2, 3 групп, пожилых, детей', 'subTitle' => ''],
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'full' => [
                'parking' => [
                    [
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 1, 'title' => 'Количество парковочных мест', 'subTitle' => 'Не менее одного на 25 мест'],
                                    ['key' => 2, 'title' => 'Размер парковки', 'subTitle' => 'Не менее 3,66 х 5,38 м'],
                                ]
                            ],
                            [
                                'title' => 'Пешеходный проход рядом с машиноместом',
                                'attributes' => [
                                    ['key' => 11, 'subTitle' => '1 место — не менее 1,2 м'],
                                    ['key' => 12, 'subTitle' => 'Если два парковочных места являются смежными — не менее 1,5 м'],
                                ]
                            ],
                            [
                                'title' => 'Обозначение автостоянки для инвалидов',
                                'attributes' => [
                                    ['key' => 3, 'title' => 'Знак на плоскости стоянки'],
                                    ['key' => 4, 'title' => 'Знак на вертикальной поверхности (стене, столбе, стойке)'],
                                    ['key' => 5, 'title' => 'Знак 5.15 «Место стоянки»'],
                                    ['key' => 6, 'title' => 'Знак 7.15 «Инвалиды»'],
                                    ['key' => 7, 'title' => 'Стрелка и расстояние'],
                                    ['key' => 8, 'title' => 'Разметка на плоскости']
                                ]
                            ],
                            [
                                'title' => 'Съезд с тротуара на парковку',
                                'attributes' => [
                                    ['key' => 13, 'subTitle' => 'Наличие съезда'],
                                    ['key' => 9, 'subTitle' => 'Ширина 1,5 м рекомендуется (было 0,9 м)'],
                                    ['key' => 14, 'subTitle' => 'Перепад высот менее 1,5 см'],
                                    ['key' => 15, 'subTitle' => 'Уклон 5%'],
                                    ['key' => 16, 'subTitle' => 'Наличие предупреждающих полос']
                                ]
                            ],
                            [
                                'title' => 'Расстояние до входа в здание',
                                'attributes' => [
                                    ['key' => 10, 'subTitle' => 'Для общественных зданий менее 50 м'],
                                    ['key' => 17, 'subTitle' => 'Для жилых зданий менее 100 м'],
                                ]
                            ],
                            [
                                'title' => 'Путь движения снаружи здания (дорожки, тротуары, пандусы и пр.)',
                                'attributes' => [
                                    ['key' => 18, 'subTitle' => 'Ширина в одном направлении не менее 1,5 м'],
                                    ['key' => 19, 'subTitle' => 'Ширина при встречном направлении более 2 м'],
                                    ['key' => 20, 'subTitle' => 'Ширина в одном направлении не менее 1,5 м'],
                                    ['key' => 21, 'subTitle' => 'Если из-за условий застройки ширина пути движения в пределах прямой видимости снижена до 1,2 м, то не более чем через каждые 25 м присутствуют горизонтальные площадки (карманы) размером не менее 2 х 1,8 м для обеспечения возможного разъезда людей на креслах-колясках.'],
                                    ['key' => 22, 'subTitle' => 'Пандусы на тротуарных дорожках в случае перепада уровней поверхностей более 2 см'],
                                    ['key' => 23, 'subTitle' => 'Все безопасные пешеходные дорожки обозначены окрашиванием линий в желтый цвет либо отличительной текстурой поверхности'],
                                    ['key' => 24, 'title' => 'Ширина транспортного проезда у входа', 'subTitle' => 'Не менее 5 м (было 3 м)'],
                                ]
                            ]
                        ]
                    ],
                ],
                'entrance' => [
                    [
                        'subGroups' => [
                            [
                                'title' => 'Количество входов для маломобильных групп населения',
                                'attributes' => [
                                    ['key' => 41, 'subTitle' => '1-3 входа: не менее одного входа для маломобильных групп населения'],
                                    ['key' => 42, 'subTitle' => '3-5 входов: не менее двух входов для маломобильных групп населения'],
                                    ['key' => 43, 'subTitle' => 'Более 5 входов: не менее 50% входов для маломобильных групп населения'],
                                    ['key' => 1, 'title' => 'Вход на уровне земли']
                                ],
                            ],
                        ]
                    ],
                    [
                        'title' => 'Лестница наружная',
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 2, 'title' => 'Предупреждающая полоса', 'subTitle' => 'Тактильная за 30-40 см до первой и последней ступени марша шириной не менее 56 см, контрастная шириной 30 см'],
                                    ['key' => 3, 'title' => 'Ширина проступей лестниц не менее 40 см'],
                                    ['key' => 4, 'title' => 'Высота подъема ступеней не более 12 см'],
                                    ['key' => 5, 'title' => 'Количество ступеней', 'subTitle' => 'В одном марше от 3 до 12, одиночные ступени недопустимы'],
                                    ['key' => 6, 'title' => 'Ширина марша лестниц не менее 1,35 м'],
                                ]
                            ],
                            [
                                'title' => 'Поручни перил при перепадах высот более 0,45 м',
                                'attributes' => [
                                    ['key' => 7, 'subTitle' => 'Вдоль обеих сторон'],
                                    ['key' => 8, 'subTitle' => 'На высоте 0,9 м для взрослых, 0,5 м для детей'],
                                    ['key' => 9, 'subTitle' => 'Горизонтальный закругленный вылет после последней опоры 30 см'],
                                    ['key' => 10, 'subTitle' => 'При ширине лестничного марша более 2,5 м — разделительные поручни'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Пандус наружный',
                        'subGroups' => [
                            [
                                'title' => 'Покрытие пандуса',
                                'attributes' => [
                                    ['key' => 11, 'subTitle' => 'Твёрдые материалы'],
                                    ['key' => 12, 'subTitle' => 'Без зазоров'],
                                    ['key' => 13, 'subTitle' => 'Без вибрации при движении'],
                                    ['key' => 14, 'subTitle' => 'Предотвращающее скольжение'],
                                    ['key' => 15, 'title' => 'Ширина марша не менее 1,2 м'],
                                ]
                            ],
                            [
                                'title' => 'Разворотные горизонтальные площадки',
                                'attributes' => [
                                    ['key' => 44, 'subTitle' => 'В начале каждого уровня'],
                                    ['key' => 45, 'subTitle' => 'В конце каждого уровня'],
                                    ['key' => 16, 'subTitle' => 'Размеры 1,2 х 1,5 м'],
                                    ['key' => 46, 'subTitle' => 'Контрастная или тактильная полоска'],
                                    ['key' => 47, 'subTitle' => 'Через каждые 8-9 м'],
                                    ['key' => 17, 'title' => 'Высота марша 40-45 см'],
                                    ['key' => 18, 'title' => 'Уклон', 'subTitle' => 'При высоте подъёма выше 20 см — 1 : 20 (5% или 2,9°) При высоте подъёма до 20 см — 1 : 10 (10% или 5,7°)'],
                                    ['key' => 19, 'title' => 'Бортики не менее 5 см'],
                                ]
                            ],
                            [
                                'title' => 'Поручни перил при перепадах высот более 0,45 м',
                                'attributes' => [
                                    ['key' => 20, 'subTitle' => 'Вдоль обеих сторон'],
                                    ['key' => 21, 'subTitle' => 'На высоте 0,7-0,9 м для взрослых, 0,5 м для детей'],
                                    ['key' => 48, 'subTitle' => 'Высота ограждения под пандусами на высоте не менее 0,7 м'],
                                    ['key' => 49, 'subTitle' => 'Расстояние между поручнем и стеной не менее 4 см (если у стены шероховатая поверхность — не менее 6 см)'],
                                    ['key' => 50, 'subTitle' => 'Диаметр поручней — 3,5-4,5 см при круглом сечении'],
                                    ['key' => 22, 'subTitle' => 'Горизонтальный закругленный вылет после последней опоры 30 см'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Подъёмник наружный электрический',
                        'subGroups' => [
                            [
                                'title' => 'Стационарные подъёмники',
                                'attributes' => [
                                    ['key' => 51, 'subTitle' => 'Свободное пространство перед — не менее 0,9 х 1,5 м'],
                                    ['key' => 23, 'subTitle' => 'Параметры не менее 0,9 х 1,2 м'],
                                    ['key' => 24, 'subTitle' => 'Жёсткое ограждение со всех сторон'],
                                    ['key' => 25, 'subTitle' => 'Бортики'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Входная площадка, входная дверь, тамбур',
                        'subGroups' => [
                            [
                                'title' => 'Входная площадка с пандусом',
                                'attributes' => [
                                    ['key' => 26, 'subTitle' => 'Размеры не менее 2,2 х 2,2 м'],
                                    ['key' => 52, 'subTitle' => 'Наличие навеса или водоотвода'],
                                ]
                            ],
                            [
                                'title' => 'Глубина пространства перед дверью',
                                'attributes' => [
                                    ['key' => 27, 'subTitle' => 'При открывании «от себя» — не менее 1,2 м'],
                                    ['key' => 28, 'subTitle' => 'При открывании «к себе» — не менее 1,5 м'],
                                    ['key' => 53, 'subTitle' => 'Ширина 1,5 м'],
                                ]
                            ],
                            [
                                'title' => 'Входная дверь',
                                'attributes' => [
                                    ['key' => 29, 'subTitle' => 'Открытие в противоположную сторону от пандуса'],
                                    ['key' => 30, 'subTitle' => 'Ширина в свету не менее 90 см'],
                                    ['key' => 31, 'subTitle' => 'Пороги не выше 1,4 см'],
                                    ['key' => 54, 'subTitle' => 'Механизм автоматического закрывания двери срабатывает не менее чем через 5 сек'],
                                    ['key' => 55, 'subTitle' => 'Ручка универсальная (для возможности открытия и закрытия со сжатым кулаком)'],
                                    ['key' => 56, 'subTitle' => 'Легкость открытия и закрытия двери (усилие открывания не более 50 Нм)'],
                                    ['key' => 57, 'subTitle' => 'При наличии вращающихся дверей, турникетов должна быть створчатая дверь'],
                                    ['key' => 58, 'subTitle' => 'Ширина турникетов (в свету) не менее 1,2 м'],
                                ]
                            ],
                            [
                                'title' => 'Стеклянная дверь',
                                'attributes' => [
                                    ['key' => 32, 'subTitle' => 'Наличие предупреждения для слабовидящих на стеклянной двери'],
                                    ['key' => 33, 'subTitle' => 'Прямоугольник 10 х 20 см²'],
                                    ['key' => 34, 'subTitle' => 'Цвет яркий (контрастный)'],
                                    ['key' => 35, 'subTitle' => 'На высоте не ниже 1,2 м и не выше 1,5 м'],
                                ]
                            ],
                            [
                                'title' => 'Тамбуры',
                                'attributes' => [
                                    ['key' => 36, 'subTitle' => '1,5-1,8 м (глубина) х 2 м (ширина)'],
                                    ['key' => 37, 'subTitle' => '2,3 м (глубина) х  1,5 м (ширина)'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Ситуационная помощь на входе',
                        'subGroups' => [
                            [
                                'title' => 'Кнопка вызова персонала',
                                'attributes' => [
                                    ['key' => 38, 'subTitle' => 'Доступность, высота 85 см  – 1 м'],
                                    ['key' => 39, 'subTitle' => 'Навес от осадков'],
                                    ['key' => 40, 'subTitle' => 'Шрифт Брайля'],
                                ]
                            ]
                        ]
                    ]
                ],
                'movement' => [
                    [
                        'title' => 'Территория пути передвижения',
                        'subGroups' => [
                            [
                                'title' => 'Ширина пути движения (коридор)',
                                'attributes' => [
                                    ['key' => 1, 'subTitle' => 'В одном направлении – 1,5 м'],
                                    ['key' => 38, 'subTitle' => 'При встречном движении – 1,8 м'],
                                    ['key' => 39, 'title' => 'Минимальные размеры площади, занимаемой человеком на кресло-коляске 1,2 х 0,9 м'],
                                    ['key' => 40, 'title' => 'Минимальная ширина пространства для разворота на кресло-коляске не менее 1,8 м']
                                ]
                            ],
                            [
                                'title' => 'Покрытие пола',
                                'attributes' => [
                                    ['key' => 2, 'subTitle' => 'Твёрдые материалы'],
                                    ['key' => 3, 'subTitle' => 'Без зазоров'],
                                    ['key' => 4, 'subTitle' => 'Без вибрации при движении'],
                                    ['key' => 5, 'subTitle' => 'Предотвращающее скольжение'],
                                    ['key' => 41, 'subTitle' => 'Ковровое покрытие прикреплено к полу'],
                                    ['key' => 42, 'subTitle' => 'Ворсовые ковры не более 1,3 см'],
                                    ['key' => 43, 'title' => 'Ширина перехода в другое здание не менее 2,0 м'],
                                    ['key' => 44, 'title' => 'Ширина прохода в помещении с оборудованием и мебелью не менее 1,2 м'],
                                    ['key' => 45, 'title' => 'Свободное пространство между неподвижными объектами не менее 0,9 х 1,5 м'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Двери внутренние',
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 6, 'title' => 'Ширина дверей не менее 90 см'],
                                    ['key' => 7, 'title' => 'Высота порогов не более 1,4 см']
                                ]
                            ],
                            [
                                'title' => 'Стеклянная дверь',
                                'attributes' => [
                                    ['key' => 8, 'subTitle' => 'Наличие предупреждения для слабовидящих на стеклянной двери'],
                                    ['key' => 9, 'subTitle' => 'Прямоугольник 10 х 20 см²'],
                                    ['key' => 10, 'subTitle' => 'Цвет яркий (контрастный)'],
                                    ['key' => 11, 'subTitle' => 'На высоте не ниже 1,2 м и не выше 1,5 м'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Лестницы внутренние',
                        'subGroups' => [
                            [
                                'title' => 'Рифление и контрастные полосы на ступенях лестниц (верхняя и нижняя ступени в каждом марше)',
                                'attributes' => [
                                    ['key' => 12, 'subTitle' => 'Контрастный цвет'],
                                    ['key' => 13, 'subTitle' => 'Тактильные указатели'],
                                    ['key' => 14, 'subTitle' => 'Ширина полосы 30 см'],
                                    ['key' => 15, 'title' => 'Ширина марша лестниц не менее 1,35 м'],
                                    ['key' => 16, 'title' => 'Ширина проступей лестниц не менее 30 см'],
                                    ['key' => 17, 'title' => 'Высота подъема ступеней не более 15 см'],
                                    ['key' => 46, 'title' => 'Уклоны лестниц', 'subTitle' => 'Соотношение высоты подъема ступени к ширине проступи не более 1 : 2'],
                                    ['key' => 18, 'title' => 'Максимальное число ступеней на пролет', 'subTitle' => 'В одном марше от 3 до 12, одиночные ступени недопустимы'],
                                ]
                            ],
                            [
                                'title' => 'Поручни перил при перепадах высот более 0,45 м',
                                'attributes' => [
                                    ['key' => 19, 'subTitle' => 'Вдоль обеих сторон'],
                                    ['key' => 20, 'subTitle' => 'На высоте 0,9 м для взрослых, 0,5 м для детей'],
                                    ['key' => 47, 'subTitle' => 'Расстояние между поручнем и стеной не менее 4 см (если у стены шероховатая поверхность — не менее 6 см)'],
                                    ['key' => 48, 'subTitle' => 'Диаметр поручней – 3,5-4,5 см при круглом сечении'],
                                    ['key' => 21, 'subTitle' => 'Горизонтальный закругленный вылет после последней опоры 30 см'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Пандусы внутренние',
                        'subGroups' => [
                            [
                                'title' => 'Покрытие пандуса',
                                'attributes' => [
                                    ['key' => 22, 'subTitle' => 'Твёрдые материалы'],
                                    ['key' => 23, 'subTitle' => 'Без зазоров'],
                                    ['key' => 24, 'subTitle' => 'Без вибрации при движении'],
                                    ['key' => 25, 'subTitle' => 'Предотвращающее скольжение'],
                                ]
                            ],
                            [
                                'title' => 'Разворотные горизонтальные площадки',
                                'attributes' => [
                                    ['key' => 49, 'subTitle' => 'В начале каждого уровня'],
                                    ['key' => 50, 'subTitle' => 'В конце каждого уровня'],
                                    ['key' => 26, 'subTitle' => 'Размеры 1,2 х 1,5 м'],
                                    ['key' => 51, 'subTitle' => 'Контрастная или тактильная полоска при уклоне'],
                                ]
                            ],
                            [
                                'title' => 'Поручни перил при перепадах высот более 0,45 м',
                                'attributes' => [
                                    ['key' => 27, 'subTitle' => 'Вдоль обеих сторон'],
                                    ['key' => 28, 'subTitle' => 'На высоте 0,7-0,9 м для взрослых, 0,5 м для детей'],
                                    ['key' => 52, 'subTitle' => 'Высота ограждения под пандусами на высоте не менее 0,7 м'],
                                    ['key' => 53, 'subTitle' => 'Расстояние между поручнем и стеной не менее 4 см (если у стены шероховатая поверхность – не менее 6 см)'],
                                    ['key' => 54, 'subTitle' => 'Диаметр поручней – 3,5-4,5 см при круглом сечении'],
                                    ['key' => 29, 'subTitle' => 'Горизонтальный закругленный вылет после последней опоры 30 см'],
                                    ['key' => 30, 'title' => 'Ширина марша не менее 1,2 м'],
                                    ['key' => 31, 'title' => 'Высота марша 40-45 см'],
                                    ['key' => 32, 'title' => 'Уклон', 'subTitle' => 'При высоте подъёма выше 20 см — 1 : 20 (5% или 2,9°)'],
                                    ['key' => 33, 'title' => 'Бортики не менее 5 см'],
                                ]
                            ]
                        ]
                    ],
                    [
                        'title' => 'Лифты и электрические подъемники внутренние',
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 34, 'title' => 'Габариты кабины лифта', 'subTitle' => 'Не менее 1,3 х 2,1 м'],
                                    ['key' => 35, 'title' => 'Ширина двери в кабину не менее 90 см'],
                                    ['key' => 55, 'title' => 'Свободное пространство перед кнопкой вызова лифта', 'subTitle' => 'Не менее 0,9 х 1,2 м'],
                                    ['key' => 56, 'title' => 'Кнопка вызова лифта в коридоре', 'subTitle' => 'На высоте от 0,9 м до 1,2 м от уровня пола'],
                                    ['key' => 57, 'title' => 'Поручни', 'subTitle' => 'Расположенные по трем сторонам на высоте от 0,8 м до 0,9 м от уровня пола'],
                                ]
                            ],
                            [
                                'title' => 'Информация для людей, имеющих проблемы со зрением',
                                'attributes' => [
                                    ['key' => 36, 'subTitle' => 'Надписи, выполненные шрифтом Брайля на кнопках'],
                                    ['key' => 37, 'subTitle' => 'Не сенсорные кнопки'],
                                    ['key' => 58, 'subTitle' => 'Звуковое и видео информирование'],
                                    ['key' => 59, 'title' => 'Кнопка аварийного вызова'],
                                ]
                            ],
                            [
                                'title' => 'Стационарные подъемники',
                                'attributes' => [
                                    ['key' => 60, 'subTitle' => 'Свободное пространство перед – не менее 0,9 м х 1,5 м'],
                                    ['key' => 61, 'subTitle' => 'Параметры – не менее 0,9 х 1,2 м'],
                                    ['key' => 62, 'subTitle' => 'Жесткое ограждение со всех сторон'],
                                    ['key' => 63, 'subTitle' => 'Бортики'],
                                ]
                            ]
                        ]
                    ]
                ],
                'service' => [
                    [
                        'subGroups' => [
                            [
                                'title' => 'Размеры рабочей поверхности стола, стойки',
                                'attributes' => [
                                    ['key' => 1, 'subTitle' => 'Высота не более 80 см от уровня пола'],
                                    ['key' => 2, 'subTitle' => 'Коленное пространство не менее 70 см'],
                                    ['key' => 6, 'subTitle' => 'Глубина – не менее 0,5 м'],
                                    ['key' => 7, 'title' => 'Свободное пространство около мебели', 'subTitle' => 'Не менее 0,9 м х 1,5 м'],
                                    ['key' => 3, 'title' => 'Опознавательные таблички', 'subTitle' => 'Высота размещения от 1,4 м до 1,6 м']
                                ]
                            ],
                            [
                                'title' => 'Зона досягаемости для людей на кресло-колясках',
                                'attributes' => [
                                    ['key' => 4, 'subTitle' => 'При расположении сбоку от посетителя — не выше 1,4 м и не ниже 0,3 от уровня пола'],
                                    ['key' => 5, 'subTitle' => 'При фронтальном подходе — не выше 1,2 м и не ниже 0,4 м от уровня пола']
                                ]
                            ],
                            [
                                'title' => 'Ширина проходов',
                                'attributes' => [
                                    ['key' => 8, 'subTitle' => 'Не менее 0,9 м'],
                                    ['key' => 9, 'subTitle' => 'В местах разворота не менее 1,5 м'],
                                    ['key' => 10, 'title' => 'Кассовые аппараты', 'subTitle' => 'Ширина прохода около кассового аппарата не менее 1,1 м'],
                                    ['key' => 11, 'title' => 'Банковские аппараты', 'subTitle' => 'Площадка перед банкоматом не менее 0,9 м х 1,2 м'],
                                    ['key' => 12, 'title' => 'Вокзалы, аэропорты', 'subTitle' => 'Наличие специальной службы сопровождения'],
                                    ['key' => 13, 'title' => 'Объекты культурного и спортивного назначения', 'subTitle' => 'Наличие не менее 1,5% мест для зрителей на инвалидных колясках'],
                                ]
                            ]
                        ]
                    ]
                ],
                'toilet' => [
                    [
                        'subGroups' => [
                            [
                                'title' => 'Наличие уборной',
                                'attributes' => [
                                    ['key' => 1, 'subTitle' => 'Расчётная численность посетителей более 50 человек'],
                                    ['key' => 2, 'subTitle' => 'Продолжительности нахождения в здании более 60 минут']
                                ]
                            ],
                            [
                                'title' => 'Дверь в уборную',
                                'attributes' => [
                                    ['key' => 3, 'subTitle' => 'Дверь открывается наружу'],
                                    ['key' => 4, 'subTitle' => 'Снаружи размещена криптограмма'],
                                    ['key' => 5, 'subTitle' => 'Ширина двери не менее 1,2 м'],
                                    ['key' => 6, 'subTitle' => 'Поручни на внутренней стороне двери длиной не менее 60 см'],
                                    ['key' => 7, 'subTitle' => 'Высота порогов не более 1,4 см'],
                                    ['key' => 21, 'subTitle' => 'Ручка универсальная'],
                                    ['key' => 22, 'subTitle' => 'Легкость открытия и закрытия двери (усилие открывания не более 50Нм)'],
                                ]
                            ],
                            [
                                'title' => 'Размеры',
                                'attributes' => [
                                    ['key' => 8, 'subTitle' => 'Универсальная кабина – не менее 1,65 х 2,0 м'],
                                    ['key' => 23, 'subTitle' => 'Ванная комната или совмещенный санузел – не менее 2,2 х 2,2 м'],
                                    ['key' => 24, 'subTitle' => 'Уборная с умывальником – не менее 1,6 х 2,2 м'],
                                    ['key' => 25, 'subTitle' => 'Уборная без умывальника – не менее 1,2 х 1,6 м'],
                                ]
                            ],
                            [
                                'title' => 'Раковина/умывальник',
                                'attributes' => [
                                    ['key' => 26, 'subTitle' => 'Размер 0,5 × 0,4 м'],
                                    ['key' => 27, 'subTitle' => 'Высота верхнего края от уровня пола от 0,8 м до 0,85 м'],
                                    ['key' => 28, 'subTitle' => 'Коленное пространство шириной не менее 0,75 м, глубиной не менее 0,68 м'],
                                    ['key' => 29, 'subTitle' => 'Свободное пространство перед умывальником 0,75 х 1,2 м, из которых 0,48 м могут быть под раковиной'],
                                ]
                            ],
                            [
                                'title' => 'Унитаз/писсуар',
                                'attributes' => []
                            ],
                            [
                                'title' => 'Поручни около унитаза:',
                                'attributes' => [
                                    ['key' => 30, 'subTitle' => '— с двух сторон унитаза'],
                                    ['key' => 31, 'subTitle' => '— на высоте 0,8-0,9 м, в том числе один поручень откидной'],
                                    ['key' => 32, 'subTitle' => 'Поручни около писсуара на высоте от 1,0 м до 1,5 м от уровня пола'],
                                    ['key' => 33, 'subTitle' => 'Свободное пространство 0,75 х 1,2 м'],
                                ]
                            ],
                            [
                                'title' => 'Другое оборудование',
                                'attributes' => [
                                    ['key' => 9, 'subTitle' => 'Крючки для одежды'],
                                    ['key' => 10, 'subTitle' => 'Крючки для костылей'],
                                    ['key' => 11, 'subTitle' => 'Крючки для других принадлежностей'],
                                    ['key' => 12, 'subTitle' => 'Зеркало'],
                                    ['key' => 13, 'subTitle' => 'Дозатор с мылом'],
                                    ['key' => 14, 'subTitle' => 'Диспенсер для туалетной бумаги и салфеток'],
                                    ['key' => 15, 'subTitle' => 'Электрическая сушилка для рук'],
                                    ['key' => 16, 'subTitle' => 'Урна'],
                                    ['key' => 17, 'subTitle' => 'Открывающиеся части предметов на высоте от 1,0 до 1,2 м'],
                                ]
                            ],
                            [
                                'title' => 'Кнопка вызова SOS',
                                'attributes' => [
                                    ['key' => 18, 'subTitle' => 'На высоте от 40 см до 60 см над уровнем пола'],
                                    ['key' => 19, 'subTitle' => 'На расстоянии от края унитаза от 15 см до 30 см'],
                                    ['key' => 20, 'subTitle' => 'Указатель «Кнопка экстренного вызова»'],
                                ]
                            ]
                        ]
                    ]
                ],
                'navigation' => [
                    [
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 1, 'title' => 'Указатели и информационный материал', 'subTitle' => 'Контрастные крупные буквы, выделенные жирным шрифтом'],
                                    ['key' => 2, 'title' => 'Форматы информации', 'subTitle' => 'Шрифт Брайля, аудио-версия, радиомаяки, радиометки, радиоинформаторы'],
                                    ['key' => 3, 'title' => 'Знаки и символы', 'subTitle' => 'Международные знаки и символы на контрастном фоне'],
                                    ['key' => 4, 'title' => 'Форматы информации', 'subTitle' => 'Визуальные, тактильные, звуковые, световые указатели, табло и пиктограммы, а также контрастное цветовое решение элементов интерьера, переводчик с жестового языка'],
                                ]
                            ],
                            [
                                'title' => 'Визуальная информация',
                                'attributes' => [
                                    ['key' => 8, 'subTitle' => 'Пути экстренной эвакуации'],
                                    ['key' => 9, 'subTitle' => 'Расписание'],
                                    ['key' => 10, 'subTitle' => 'Номера кабинетов'],
                                    ['key' => 11, 'subTitle' => 'Высота размещения табличек от 1,4 м до 1,6 м'],
                                    ['key' => 12, 'subTitle' => 'Размещение табличек на стене со стороны ручки двери'],
                                    ['key' => 13, 'subTitle' => 'Текст написан большими буквами, жирным шрифтом, на контрастном фоне'],
                                    ['key' => 14, 'subTitle' => 'Текст написан на государственном и русском языке'],
                                    ['key' => 15, 'subTitle' => 'Электронные табло'],

                                ]
                            ],
                            [
                                'title' => 'Тактильная информация',
                                'attributes' => []
                            ],
                            [
                                'title' => 'Рельефные тактильные обозначения путей движения:',
                                'attributes' => [
                                    ['key' => 5, 'subTitle' => '— непрерывные тактильные обозначения путей движения'],
                                    ['key' => 16, 'subTitle' => '— контрастного (желтого) цвета'],
                                    ['key' => 6, 'subTitle' => '— предупреждающая тактильная полоса за 0,3 м до любого препятствия (дверь, лестница, пандус и т.д.), ширина не менее 0,56 м, в длину – не менее ширины препятствия'],
                                    ['key' => 17, 'subTitle' => '— направляющая тактильная плитка в ширину не менее 0,55 м (высота не более 0,025 м)'],
                                    ['key' => 18, 'subTitle' => 'Указатели кабинетов шрифтом Брайля'],
                                    ['key' => 19, 'subTitle' => 'Кнопки в лифтах шрифтом Брайля'],
                                    ['key' => 20, 'subTitle' => 'Номера этажей шрифтом Брайля'],
                                    ['key' => 21, 'subTitle' => 'Режим работы шрифтом Брайля'],
                                    ['key' => 22, 'subTitle' => 'Контрастная или тактильная полоса, обозначающая уровни пандуса'],
                                    ['key' => 7, 'title' => 'Мнемосхема', 'subTitle' => 'Размещение с правой стороны на расстоянии от 3 м до 5 м от входа в объект'],
                                ]
                            ]
                        ]
                    ]
                ],
                'serviceAccessibility' => [
                    [
                        'subGroups' => [
                            [
                                'attributes' => [
                                    ['key' => 1, 'title' => 'Универсальный проект', 'subTitle' => 'Услуга оказывается во всем здании'],
                                    ['key' => 2, 'title' => 'Разумное приспособление', 'subTitle' => 'Услуга оказывается на 1 этаже'],
                                    ['key' => 3, 'title' => 'Есть доставка товаров или вызов специалиста на дом ', 'subTitle' => 'Услуга оказывается дистанционно'],
                                    ['key' => 4, 'title' => 'Кнопка вызова персонала ', 'subTitle' => ''],
                                    ['key' => 5, 'title' => 'Оказание ситуационной помощи со стороны персонала ', 'subTitle' => ''],
                                    ['key' => 6, 'title' => 'Протоколы/инструкции по коммуникации и оказанию помощи маломобильным гражданам', 'subTitle' => 'Был ли обучен персонал'],
                                    ['key' => 7, 'title' => 'Льготы для людей с инвалидностью 1, 2, 3 групп, пожилых, детей', 'subTitle' => ''],
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
