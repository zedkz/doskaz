<?php


namespace App\Objects;

use App\Objects\Adding\AccessibilityScore;
use Goodwix\DoctrineJsonOdm\Annotation\ODM;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * @ODM()
 * @DiscriminatorMap(
 *     typeProperty="type",
 *     mapping={
 *         "small" = "App\Objects\Zone\Small\SmallFormZones",
 *         "middle" = "App\Objects\Zone\Middle\MiddleFormZones",
 *         "full" = "App\Objects\Zone\Full\FullFormZones",
 *     }
 * )
 */
interface Zones
{
    public function overallScore(): AccessibilityScore;
}
