<?php
declare(strict_types=1);

namespace App\Complaints;


use App\Cities\Cities;
use App\Infrastructure\Doctrine\Flusher;
use Doctrine\DBAL\Connection;
use OpenApi\Annotations\JsonContent;
use OpenApi\Annotations\Post;
use OpenApi\Annotations\RequestBody;
use OpenApi\Annotations\Response;
use Safe\Exceptions\FilesystemException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use TheCodingMachine\Gotenberg\Client;
use TheCodingMachine\Gotenberg\ClientException;
use TheCodingMachine\Gotenberg\DocumentFactory;
use TheCodingMachine\Gotenberg\HTMLRequest;
use TheCodingMachine\Gotenberg\RequestException;

/**
 * @IsGranted("ROLE_USER")
 * @Route(path="/api/complaints")
 */
final class ComplaintController extends AbstractController
{
    /**
     * @Route(path="/validate", methods={"POST"})
     * @param ComplaintData $complaintData
     * @Post(path="/api/complaints/validate",
     *     tags={"Жалобы"},
     *     summary="Валидация жалобы",
     *     @RequestBody(required=true, description="Жалоба", @JsonContent(ref="#/components/schemas/Complaint")),
     *     responses={
     *         @Response(response="204", description="No content"),
     *         @Response(response="401", description="Not authorized"),
     *         @Response(response="400", description="Bad content")
     * })
     */
    public function validate(ComplaintData $complaintData) {

    }

    /**
     * @Route(methods={"POST"})
     * @param ComplaintData $complaintData
     * @param ComplaintRepository $complaintRepository
     * @param Flusher $flusher
     *
     * @Post(path="/api/complaints",
     *     tags={"Жалобы"},
     *     summary="Подача жалобы",
     *     @RequestBody(required=true, description="Жалоба", @JsonContent(ref="#/components/schemas/Complaint")),
     *     responses={
     *         @Response(response="204", description="No content"),
     *         @Response(response="401", description="Not authorized"),
     *         @Response(response="400", description="Bad content")
     * })
     */
    public function make(ComplaintData $complaintData, ComplaintRepository $complaintRepository, Flusher $flusher)
    {
        $complaint = new Complaint($complaintData->complainant, $complaintData->content, $complaintData->authorityId, $this->getUser()->id());
        $complaintRepository->add($complaint);
        $flusher->flush();
    }

    /**
     * @Route(path="/authorities", methods={"GET"})
     * @param Connection $connection
     * @return mixed[]
     */
    public function complaintAuthorities(Connection $connection)
    {
        return $connection->createQueryBuilder()
            ->select('id', 'name')
            ->from('complaint_authorities')
            ->where('deleted_at IS NULL')
            ->orderBy('id', 'desc')
            ->execute()
            ->fetchAll();
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route(methods={"GET"})
     * @param Request $request
     * @param Connection $connection
     * @return mixed[]
     */
    public function list(Request $request, Connection $connection)
    {
        $complaintsQuery = $connection->createQueryBuilder()
            ->select('id', 'created_at as "createdAt"', 'concat(complaints.complainant->>\'lastName\', \' \', complaints.complainant->>\'firstName\', \' \', complaints.complainant->>\'middleName\') as "fullName"')
            ->from('complaints');

        return [
            'items' => array_map(function ($complaint) use ($connection) {
                return array_replace($complaint, [
                    'createdAt' => $connection->convertToPHPValue($complaint['createdAt'], 'datetimetz_immutable')
                ]);
            }, (clone $complaintsQuery)->orderBy('id', 'desc')->setMaxResults($request->query->getInt('limit', 20))
                ->setFirstResult($request->query->getInt('offset', 0))
                ->execute()->fetchAll()),
            'count' => $complaintsQuery->select('COUNT(*)')->execute()->fetchColumn()
        ];
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route(path="/{id}/pdf", methods={"GET"}, requirements={"id" = "\d+"})
     * @param $id
     * @param Connection $connection
     * @return BinaryFileResponse
     * @throws ClientException
     * @throws FilesystemException
     * @throws RequestException
     */
    public function pdfExport($id, Connection $connection)
    {
        $data = $connection->createQueryBuilder()
            ->select('complaint_authorities.name as "authorityName"')
            ->addSelect('complaints.complainant->>\'iin\' as "complainantIin"')
            ->addSelect('complaints.complainant->>\'cityId\' as "complainantCityId"')
            ->addSelect('complaints.complainant->>\'phone\' as "complainantPhone"')
            ->addSelect('complaints.complainant->>\'lastName\' as "complainantLastName"')
            ->addSelect('complaints.complainant->>\'firstName\' as "complainantFirstName"')
            ->addSelect('complaints.complainant->>\'middleName\' as "complainantMiddleName"')
            ->addSelect('complaints.complainant->>\'street\' as "complainantStreet"')
            ->addSelect('complaints.complainant->>\'building\' as "complainantBuilding"')
            ->addSelect('complaints.complainant->>\'apartment\' as "complainantApartment"')
            ->addSelect('complaints.content->>\'visitedAt\' as "visitedAt"')
            ->addSelect('complaints.content->>\'cityId\' as "cityId"')
            ->addSelect('complaints.content->>\'street\' as "street"')
            ->addSelect('complaints.content->>\'building\' as "building"')
            ->addSelect('complaints.content->>\'visitPurpose\' as "visitPurpose"')
            ->addSelect('complaints.content->>\'objectName\' as "objectName"')
            ->addSelect('complaints.created_at as "createdAt"')
            ->addSelect('complaints.content->>\'type\' as type')
            ->addSelect('complaints.content->\'photos\' as photos')
            ->addSelect('complaints.content->\'options\' as "options"')
            ->addSelect('complaints.content->\'threatToLife\' as "threatToLife"')
            ->addSelect('complaints.content->>\'comment\' as comment')
            ->addSelect('complaints.content->>\'videos\' as videos')
            ->from('complaints')
            ->leftJoin('complaints', 'complaint_authorities', 'complaint_authorities', 'complaints.authority_id = complaint_authorities.id')
            ->setMaxResults(1)
            ->andWhere('complaints.id = :id')
            ->setParameter('id', $id)
            ->execute()->fetch();

        if (!$data) {
            throw new NotFoundHttpException();
        }

        $data['photos'] = json_decode($data['photos'], true);
        $data['videos'] = json_decode($data['videos'], true);

        $selectedOptions = json_decode($data['options'] ?? '[]', true);
        $client = new Client('http://gotenberg:3000');
        $index = DocumentFactory::makeFromString('complaint.html', $this->renderView('complaints/pdf.html.twig', array_merge($data, [
            'complainantCity' => Cities::find((int)$data['complainantCityId']),
            'city' => Cities::find((int)$data['cityId']),
            'attributes' => $this->complaintAttributes(),
            'selectedAttributes' => array_map(function($attr) use($selectedOptions) {
                return [
                    'title' => $attr['title'],
                    'options' => array_filter($attr['options'], function ($option) use ($selectedOptions) {
                        return array_key_exists($option['key'], $selectedOptions);
                    })
                ];
            }, $this->complaintAttributes())
        ])));
        $request = new HTMLRequest($index);
        $request->setMargins([0.4, 0.4, 0.4, 0.4]);
        $request->setPaperSize(HTMLRequest::A4);
        $request->setAssets(array_map(function($photo, $index) {
            return DocumentFactory::makeFromPath('image'.$index, '/app'.$photo);
        }, $data['photos'], array_keys($data['photos'])));
        $path = tempnam('/tmp', 'pdf');
        $client->store($request, $path);

        return (new BinaryFileResponse($path, 200, [], true))->deleteFileAfterSend();
    }

    public function complaintAttributes()
    {
        return [
            [
                "key" => "parking",
                "title" => "Парковка",
                "options" => [
                    [
                        "key" => "e7dc7624-c80c-4ae8-b7bd-2c69f35e06e3",
                        "label" => "Отсутствие специального парковочного места"
                    ],
                    [
                        "key" => "8ab4229b-c978-4493-b4c4-a346d57ec03b",
                        "label" => "Специальное парковочное место находится далеко от входа"
                    ],
                    [
                        "key" => "7752cb1a-365f-4d99-b536-01e3eeddeb3f",
                        "label" => "Отсутствие на асфальте специальной разметки со знаком «Инвалид»"
                    ],
                    [
                        "key" => "a5a91cab-807e-4366-b9ec-420fca40a849",
                        "label" => "Отсутствие специального знака «Инвалид» рядом с парковочным местом»"
                    ],
                    [
                        "key" => "052d6769-dd4f-49eb-a759-349596733089",
                        "label" => "Отсутствие бордюрного пандуса"
                    ],
                    [
                        "key" => "cbcba0f9-f5f9-4ee5-95fd-db9f857efdc8",
                        "label" => "Наличие высокого бордюра в месте съезда с парковки на тротуар/ бордюрного пандуса"
                    ]
                ]
            ],
            [
                "key" => "inputGroup",
                "title" => "Входная группа",
                "options" => [
                    [
                        "key" => "e91a378c-eaaf-45d8-aaf0-711def5e395b",
                        "label" => "Крутой уклон пандуса"
                    ],
                    [
                        "key" => "154ed3ee-ed9c-45b9-a93e-f1d66151c262",
                        "label" => "Узкий пандус"
                    ],
                    [
                        "key" => "202e4587-b204-4148-a478-a403011da336",
                        "label" => "Скользкое покрытие пандуса"
                    ],
                    [
                        "key" => "7946cc13-d816-4e1e-b095-21a7d4c17d41",
                        "label" => "Вместо пандуса/подъемника установлен швеллер/ колейная аппарель"
                    ],
                    [
                        "key" => "9b6eea82-3aab-43f6-a5c8-f9537e1da5fd",
                        "label" => "Отсутствие поручней у пандуса с 2-х сторон"
                    ],
                    [
                        "key" => "347a8414-ce3d-4869-933b-73eefbf44dc4",
                        "label" => "Отсутствие бортиков у пандуса"
                    ],
                    [
                        "key" => "b7985e98-a703-41c7-8cb8-2018f9297228",
                        "label" => "Подъемник в неисправном состоянии"
                    ],
                    [
                        "key" => "0e4218b0-0e96-4ea6-816e-cc87c528fac2",
                        "label" => "Отсутствие тактильной полосы на нижней и верхней ступенях лестницы"
                    ],
                    [
                        "key" => "6c675929-1b9f-4b16-83c7-5959f6933da6",
                        "label" => "Узкая разворотная площадка (начало, середина, конец пандуса)"
                    ],
                    [
                        "key" => "65661b0c-04dd-47d0-b1d0-7e8410268b8f",
                        "label" => "Узкая площадка перед входной дверью"
                    ],
                    [
                        "key" => "8b024e9b-8363-401d-8284-284c23c94df5",
                        "label" => "Узкая входная дверь"
                    ],
                    [
                        "key" => "5fdab5c7-2142-4805-bd81-290f43b84126",
                        "label" => "Наличие высокого порога у входной двери"
                    ],
                    [
                        "key" => "fb9cb374-1148-4d8e-8fc9-71c8122fb1af",
                        "label" => "Входная дверь без фиксации"
                    ],
                    [
                        "key" => "135ef242-5e6d-47c7-89d3-9c74ab2bd6d0",
                        "label" => "Отсутствие контрастной маркировки на входной стеклянной двери"
                    ],
                    [
                        "key" => "68cbf35c-3cc4-4f40-93c7-12754fe93e65",
                        "label" => "Узкий тамбур"
                    ],
                    [
                        "key" => "a3847f00-f6c1-4db7-9c3f-6419512de951",
                        "label" => "Наличие ступени (-ней) в тамбуре"
                    ]
                ]
            ],
            [
                "key" => "movement",
                "title" => "Пути движения по объекту",
                "options" => [
                    [
                        "key" => "a815cdab-07a0-4294-9453-0a2265f8c2d8",
                        "label" => "Отсутствие лифта/скаломобиля"
                    ],
                    [
                        "key" => "e2cbadbd-cd70-4015-a1be-838beab71c39",
                        "label" => "Узкий лифт"
                    ],
                    [
                        "key" => "f2d6378e-79c5-49da-abe8-6f143ad7e9c9",
                        "label" => "Отсутствие внутренних пандусов/подъемников"
                    ],
                    [
                        "key" => "74e8697d-6d85-409d-8867-c3bfef30370b",
                        "label" => "Крутой уклон внутреннего пандуса"
                    ],
                    [
                        "key" => "f0808216-223e-413a-bb05-aa52d9e9581d",
                        "label" => "Узкий внутренний пандус"
                    ],
                    [
                        "key" => "78110447-d877-412d-abb3-786a6b3a7bbb",
                        "label" => "Скользкое покрытие внутреннего пандуса"
                    ],
                    [
                        "key" => "bb43be62-8457-4ab9-be12-27b0d1e6e092",
                        "label" => "Вместо внутреннего пандуса/подъемника установлен швеллер/ колейная аппарель"
                    ],
                    [
                        "key" => "b57ca558-dfc9-4e17-b39b-cb289aa9822c",
                        "label" => "Отсутствие поручней у пандуса с 2-х сторон"
                    ],
                    [
                        "key" => "dcf1a252-d145-42a8-bae7-6749cacd323a",
                        "label" => "Отсутствие бортиков у пандуса"
                    ],
                    [
                        "key" => "3dbbc686-7340-46fb-8b59-e40ee6462b67",
                        "label" => "Подъемник в неисправном состоянии"
                    ],
                    [
                        "key" => "84eb75f9-0ea3-469e-adee-931a6ae00028",
                        "label" => "Узкий или заставленный мебелью коридор"
                    ],
                    [
                        "key" => "b8b216e8-3691-4560-b468-2da1fbdb3330",
                        "label" => "Скользкое покрытие пола"
                    ],
                    [
                        "key" => "98a7430e-9f5c-4c7d-8346-08aee38f6539",
                        "label" => "Отсутствие тактильных дорожек"
                    ],
                    [
                        "key" => "7ed5fdbf-98c8-427d-8ff4-6fd2f3c57a56",
                        "label" => "Узкая ширина дверных проемов"
                    ],
                    [
                        "key" => "fb558668-03f4-44ff-a15f-e08c7eb70e34",
                        "label" => "Высокие пороги в дверных проемах"
                    ]
                ]
            ],
            [
                "key" => "serviceZone",
                "title" => "Зона оказания услуг",
                "options" => [
                    [
                        "key" => "d45aa08a-f924-4eeb-8319-6a836842daf2",
                        "label" => "Слишком низкая/высокая рабочая поверхности стола, стойки"
                    ],
                    [
                        "key" => "a642c676-a789-4ce7-ba17-3d9ffb5332e8",
                        "label" => "Отсутствие свободного пространства около мебели"
                    ],
                    [
                        "key" => "ec7393f7-272a-42ed-b0e0-81dc56bfdc23",
                        "label" => "Отсутствие доступа к кассовым аппаратам, банкоматам и т.д."
                    ],
                    [
                        "key" => "56590b0a-d6b2-4117-9b4a-22220b441b45",
                        "label" => "Отсутствие службы сопровождения (только для вокзалов, аэропортов, поликлиник)"
                    ],
                    [
                        "key" => "a38aeb4f-1c3a-48db-b9e7-9afe24077e3f",
                        "label" => "Отсутствие специальных мест в концертных и спортивных залах, на смотровых площадках "
                    ]
                ]
            ],
            [
                "key" => "wc",
                "title" => "Туалет",
                "options" => [
                    [
                        "key" => "c1bdc1fd-8be2-4d14-98c0-dd83959c86fb",
                        "label" => "Отсутствие специально оборудованного туалета"
                    ],
                    [
                        "key" => "5ec0ae09-2aa0-4caf-aa2b-dcdd60ee24bd",
                        "label" => "Отсутствие поручней на внутренней стороне двери"
                    ],
                    [
                        "key" => "4716729e-1d01-46f6-b59c-8bf4586a20ad",
                        "label" => "Наличие высокого порога у двери"
                    ],
                    [
                        "key" => "a3f69839-36a2-40a6-bb46-54898910ab69",
                        "label" => "Узкие размеры туалетной кабины"
                    ],
                    [
                        "key" => "4e570daa-d80e-49cf-bc4f-60239c7f440b",
                        "label" => "Отсутствие свободного пространства около раковины"
                    ],
                    [
                        "key" => "7cb29da0-ea16-468e-94d4-c681dcde194d",
                        "label" => "Отсутствие поручней около унитаза"
                    ],
                    [
                        "key" => "1750cc2c-9810-4ab7-92d0-59438bd30e87",
                        "label" => "Отсутствие свободного пространства рядом с унитазом"
                    ],
                    [
                        "key" => "fb55c2c6-2369-4b0f-8658-2f5d905f275e",
                        "label" => "Отсутствие крючков"
                    ],
                    [
                        "key" => "11c27055-fc69-4e6f-a873-7e29fc5fff8c",
                        "label" => "Отсутствие кнопки экстренного вызова персонала"
                    ]
                ]
            ],
            [
                "key" => "navigation",
                "title" => "Навигация",
                "options" => [
                    [
                        "key" => "81bc70ac-5f34-40c1-8ae3-4f9ee740aab4",
                        "label" => "Отсутствие электронных табло"
                    ],
                    [
                        "key" => "4cd729da-ac47-4ae5-8014-a4105bcdc07e",
                        "label" => "Отсутствие указателей, в том числе тактильных и/или с использованием шрифта Брайля"
                    ],
                    [
                        "key" => "b117f3d1-e42f-4211-849b-66c9a50d6e2b",
                        "label" => "Отсутствие режима работы, расписания, номеров кабинетов и т.д., в том числе тактильных и/или с использованием шрифта Брайля"
                    ],
                    [
                        "key" => "1adac3a8-ddae-4550-bbbd-78800c90b2b8",
                        "label" => "Отсутствие путей экстренной эвакуации"
                    ],
                    [
                        "key" => "743e4ca9-4105-49d4-b23b-36eb58e6ae07",
                        "label" => "Отсутствие номеров этажей "
                    ],
                    [
                        "key" => "8daf9379-b0e4-4585-a06d-a8b1464a9654",
                        "label" => "Отсутствие тактильных путей движения"
                    ],
                    [
                        "key" => "6621b726-df16-4339-89d5-9a02675e2d9c",
                        "label" => "Отсутствие международных символов доступности"
                    ],
                    [
                        "key" => "9a64ac67-1180-48fb-9fb9-9f6b98ebaa86",
                        "label" => "Отсутствие звукового сопровождения визуальной информации"
                    ],
                    [
                        "key" => "e480a9ae-3b5d-4a61-ac08-40201f60e06f",
                        "label" => "Отсутствие мнемосхемы"
                    ]
                ]
            ]
        ];
    }
}
