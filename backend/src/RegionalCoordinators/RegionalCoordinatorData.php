<?php


namespace App\RegionalCoordinators;


use App\Infrastructure\ObjectResolver\DataObject;
use Symfony\Component\Validator\Constraints as Assert;

class RegionalCoordinatorData implements DataObject
{
    /**
     * @Assert\NotBlank()
     */
    public int $id;

    public CityIdCollection $cities;
}