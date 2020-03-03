<?php


namespace App\Objects\Reviews;


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
     * @Route(path="/api/objects/{id}/review", methods={"POST"})
     * @param MapObject $mapObject
     */
    public function create(MapObject $mapObject)
    {

    }
}