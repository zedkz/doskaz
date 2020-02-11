<?php


namespace App\Objects\Adding;

use App\Infrastructure\ObjectResolver\DataObject;
use Goodwix\DoctrineJsonOdm\Annotation\ODM;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * @ODM()
 * @DiscriminatorMap(
 *     typeProperty="form",
 *     mapping={
 *         "middle" = "App\Objects\Adding\MiddleFormRequestData"
 *     }
 * )
 */
interface Form extends DataObject
{

}