<?php


namespace App\Objects\Reviews;


use App\Infrastructure\Doctrine\Flusher;
use App\Objects\MapObject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class ReviewController extends AbstractController
{
    /**
     * @Route(path="/api/objects/{id}/reviews", methods={"POST"})
     * @param MapObject $mapObject
     * @param ReviewData $reviewData
     * @param ReviewRepository $repository
     * @param Flusher $flusher
     * @throws \Exception
     */
    public function create(MapObject $mapObject, ReviewData $reviewData, ReviewRepository $repository, Flusher $flusher)
    {
        $review = new Review($mapObject->id(), $reviewData->text, $this->getUser()->id());
        $repository->add($review);
        $flusher->flush();
    }
}