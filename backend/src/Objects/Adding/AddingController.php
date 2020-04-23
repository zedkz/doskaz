<?php


namespace App\Objects\Adding;

use App\Infrastructure\Doctrine\Flusher;
use App\Objects\Zone;
use OpenApi\Annotations\Items;
use OpenApi\Annotations\JsonContent;
use OpenApi\Annotations\Post;
use OpenApi\Annotations\Property;
use OpenApi\Annotations\RequestBody;
use OpenApi\Annotations\Response;
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
     * @Post(
     *     path="/api/objects/calculateZoneScore",
     *     tags={"Объекты"},
     *     summary="Рассчет оценки доступности для зоны",
     *     security={{"clientAuth": {}}},
     *     @Response(response=401, description=""),
     *     @RequestBody(
     *         @JsonContent(
     *             @Property(
     *                 property="type",
     *                 type="string",
     *                 enum={
     *                     "parking_small",
     *                     "entrance_small",
     *                     "movement_small",
     *                     "service_small",
     *                     "toilet_small",
     *                     "navigation_small",
     *                     "accessibility_small",
     *                     "serviceAccessibility_small",
     *                     "parking_middle",
     *                     "entrance_middle",
     *                     "toilet_middle",
     *                     "service_middle",
     *                     "accessibility_middle",
     *                     "serviceAccessibility_middle",
     *                     "movement_middle",
     *                     "navigation_middle",
     *                     "parking_full",
     *                     "entrance_full",
     *                     "movement_full",
     *                     "service_full",
     *                     "toilet_full",
     *                     "navigation_full",
     *                     "serviceAccessibility_full",
     *                     "accessibility_full",
     *                 }
     *             ),
     *             @Property(
     *                 property="attributes",
     *                 type="object",
     *                 @Property(type="string", property="attribute1", enum=App\Objects\Adding\Attribute::ATTRIBUTES)
     *             )
     *         )
     *     ),
     *     @Response(
     *         response=200,
     *         description="",
     *         @JsonContent(
     *             @Property(property="movement", type="string", enum=App\Objects\Adding\AccessibilityScore::SCORE_VARIANTS, description="Оценка для людей передвигающихся на кресле-коляске"),
     *             @Property(property="limb", type="string", enum=App\Objects\Adding\AccessibilityScore::SCORE_VARIANTS, description="Оценка для людей с проблемами опорно-двигательного аппарата"),
     *             @Property(property="vision", type="string", enum=App\Objects\Adding\AccessibilityScore::SCORE_VARIANTS, description="Оценка для людей с проблемами зрения"),
     *             @Property(property="hearing", type="string", enum=App\Objects\Adding\AccessibilityScore::SCORE_VARIANTS, description="Оценка для людей с проблемами слуха"),
     *             @Property(property="intellectual", type="string", enum=App\Objects\Adding\AccessibilityScore::SCORE_VARIANTS, description="Оценка для людей с расстройством интеллекта"),
     *         )
     *     ),
     * )
     */
    public function calculateZoneScore(Zone $zone): AccessibilityScore
    {
        return $zone->accessibilityScore();
    }
}
