<?php


namespace App\Objects\EventsHistory;

use Goodwix\DoctrineJsonOdm\Annotation\ODM;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * @ODM()
 * @DiscriminatorMap(
 *     typeProperty="type",
 *     mapping={
 *         "review_created" = "App\Objects\EventsHistory\Type\ReviewCreated"
 *     })
 */
interface EventData
{

}