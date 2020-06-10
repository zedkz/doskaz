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
abstract class Zones
{
    public function overallScore(): AccessibilityScore
    {
        $entrance = AccessibilityScore::average(
            $this->entrance1->accessibilityScore(),
            $this->entrance2 ? $this->entrance2->accessibilityScore() : null,
            $this->entrance3 ? $this->entrance3->accessibilityScore() : null,
        );

        if($entrance->equalsTo(AccessibilityScore::notAccessible()) || $this->serviceAccessibility->accessibilityScore()->equalsTo(AccessibilityScore::notAccessible())) {
            return AccessibilityScore::notAccessible();
        }

        return AccessibilityScore::average(
            $this->parking->accessibilityScore(),
            $this->entrance1->accessibilityScore(),
            $this->entrance2 ? $this->entrance2->accessibilityScore() : null,
            $this->entrance3 ? $this->entrance3->accessibilityScore() : null,
            $this->movement->accessibilityScore(),
            $this->service->accessibilityScore(),
            $this->toilet->accessibilityScore(),
            $this->navigation->accessibilityScore(),
            $this->serviceAccessibility->accessibilityScore()
        );
    }
}
