<?php


namespace App\Objects\PhotosAdding\Event;


use Ramsey\Uuid\UuidInterface;

class PhotosAddingRequestApproved
{
    public UuidInterface $requestId;

    /**
     * PhotosAddingRequestApproved constructor.
     * @param UuidInterface $requestId
     */
    public function __construct(UuidInterface $requestId)
    {
        $this->requestId = $requestId;
    }
}