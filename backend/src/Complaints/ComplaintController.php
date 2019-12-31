<?php
declare(strict_types=1);

namespace App\Complaints;


use App\Infrastructure\Doctrine\Flusher;
use Doctrine\DBAL\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    public function complaintAuthorities()
    {
        return [
            ['id' => 1, 'name' => 'Министерство здравоохранения РК']
        ];
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
     * @param Connection $connection
     * @return mixed[]
     */
    public function list(Connection $connection)
    {
        $complaints = $connection->createQueryBuilder()
            ->select('id', 'created_at as "createdAt"')
            ->from('complaints')
            ->orderBy('id', 'desc')
            ->execute()->fetchAll();

        return [
            'items' => array_map(function($complaint) use($connection) {
                return array_replace($complaint, [
                    'createdAt' => $connection->convertToPHPValue($complaint['createdAt'], 'datetimetz_immutable')
                ]);
            }, $complaints),
            'count' => 1
        ];
    }
}