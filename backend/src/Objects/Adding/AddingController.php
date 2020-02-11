<?php


namespace App\Objects\Adding;

use App\Infrastructure\Doctrine\Flusher;
use App\Objects\Zone;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/objects")
 * @IsGranted("ROLE_USER")
 */
class AddingController extends AbstractController
{
    /**
     * @Route(path="/add")
     * @param Form $addingRequestData
     * @param AddingRequestRepository $addingRequestRepository
     * @param Flusher $flusher
     * @return void
     */
    public function add(Form $addingRequestData, AddingRequestRepository $addingRequestRepository, Flusher $flusher)
    {
        $request = new AddingRequest($this->getUser()->id(), $addingRequestData);
        $addingRequestRepository->add($request);
        $flusher->flush();
    }

    /**
     * @Route(path="/calculateZoneScore", methods={"POST"})
     * @param Zone $zone
     * @return AccessibilityScore
     */
    public function calculateZoneScore(Zone $zone): AccessibilityScore
    {
        return $zone->calculateScore();
    }
}