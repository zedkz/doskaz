<?php


namespace App\Objects\Adding;

use App\Objects\Zone;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route(path="/api/objects")
 * @IsGranted("ROLE_USER")
 */
class AddingController
{
    /**
     * @Route(path="/add")
     * @param MiddleFormRequestData $addingRequestData
     * @return MiddleFormRequestData
     */
    public function add(MiddleFormRequestData $addingRequestData)
    {
        return $addingRequestData;
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