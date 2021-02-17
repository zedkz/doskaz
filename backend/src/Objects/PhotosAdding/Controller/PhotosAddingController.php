<?php


namespace App\Objects\PhotosAdding\Controller;


use App\Infrastructure\Doctrine\Flusher;
use App\Objects\MapObject;
use App\Objects\PhotosAdding\Entity\PhotosAddingRequest;
use App\Objects\PhotosAdding\PhotosAddingData;
use App\Objects\PhotosAdding\Repository\PhotosAddingRequestRepository;
use App\Users\Security\AuthenticatedUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/objects/{object}", requirements={"object" = "\d+"})
 * @IsGranted("ROLE_USER")
 */
class PhotosAddingController extends AbstractController
{
    /**
     * @Route(path="/addPhotos", methods={"POST"})
     * @param PhotosAddingData $photosAddingData
     * @param MapObject $object
     * @param PhotosAddingRequestRepository $photosAddingRequestRepository
     * @param Flusher $flusher
     */
    public function addPhotos(
        PhotosAddingData $photosAddingData,
        MapObject $object,
        PhotosAddingRequestRepository $photosAddingRequestRepository,
        Flusher $flusher
    )
    {
        if ($object->isDeleted()) {
            throw new NotFoundHttpException();
        }
        /**
         * @var $user AuthenticatedUser
         */
        $user = $this->getUser();
        $photosAddingRequest = new PhotosAddingRequest($object->id(), $user->id(), $photosAddingData->photos);
        $photosAddingRequestRepository->add($photosAddingRequest);
        $flusher->flush();
    }
}