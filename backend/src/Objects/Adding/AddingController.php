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
     * @Route(path="/requests", methods={"POST"})
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
     * @Route(path="/requests/validate", methods={"POST"})
     * @param Form $addingRequestData
     */
    public function validate(Form $addingRequestData) {

    }

    /**
     * @Route(path="/calculateZoneScore", methods={"POST"})
     * @param Zone $zone
     * @return AccessibilityScore
     */
    public function calculateZoneScore(Zone $zone): AccessibilityScore
    {
        return $zone->accessibilityScore();
    }
}
