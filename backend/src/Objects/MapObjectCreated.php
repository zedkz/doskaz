<?php


namespace App\Objects;


use Ramsey\Uuid\UuidInterface;

class MapObjectCreated
{
    public $id;

    /**
     * MapObjectCreated constructor.
     * @param $id
     */
    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }
}