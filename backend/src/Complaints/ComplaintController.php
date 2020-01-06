<?php
declare(strict_types=1);

namespace App\Complaints;


use App\Infrastructure\Doctrine\Flusher;
use Doctrine\DBAL\Connection;
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
     * @Route(methods={"POST"})
     * @param ComplaintData $complaintData
     * @param ComplaintRepository $complaintRepository
     * @param Flusher $flusher
     */
    public function make(ComplaintData $complaintData, ComplaintRepository $complaintRepository, Flusher $flusher)
    {
        $complaint = new Complaint($complaintData->complainant, $complaintData->content, $complaintData->authorityId, $this->getUser()->id());
        $complaintRepository->add($complaint);
        $flusher->flush();
    }

    /**
     * @Route(path="/authorities", methods={"GET"})
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
     * @Route(path="/cities", methods={"GET"})
     */
    public function complaintCities()
    {
        return [
            ['id' => 1, 'name' => 'Нур-Султан'],
            ['id' => 2, 'name' => 'Павлодар']
        ];
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
            ->addSelect('complaints.complainant->>\'address\' as "complainantAddress"')
            ->addSelect('complaints.complainant->>\'phone\' as "complainantPhone"')
            ->addSelect('complaints.complainant->>\'lastName\' as "complainantLastName"')
            ->addSelect('complaints.complainant->>\'firstName\' as "complainantFirstName"')
            ->addSelect('complaints.complainant->>\'middleName\' as "complainantMiddleName"')
            ->addSelect('complaints.content->>\'visitedAt\' as "visitedAt"')
            ->addSelect('complaints.created_at as "createdAt"')
            ->from('complaints')
            ->leftJoin('complaints', 'complaint_authorities', 'complaint_authorities', 'complaints.authority_id = complaint_authorities.id')
            ->setMaxResults(1)
            ->andWhere('complaints.id = :id')
            ->setParameter('id', $id)
            ->execute()->fetch();

        if (!$data) {
            throw new NotFoundHttpException();
        }

        $client = new Client('http://gotenberg:3000');
        $index = DocumentFactory::makeFromString('complaint.html', $this->renderView('complaints/pdf.html.twig', $data));
        $request = new HTMLRequest($index);
        $request->setMargins([0.4, 0.4, 0.4, 0.4]);
        $request->setPaperSize(HTMLRequest::A4);

        $path = tempnam('/tmp', 'pdf');
        $client->store($request, $path);

        return (new BinaryFileResponse($path, 200, [], true))->deleteFileAfterSend();
    }
}
