<?php


namespace App\Objects;


use App\Infrastructure\ObjectResolver\DataObject;
use App\Objects\Adding\AccessibilityScore;
use App\Objects\Adding\Attribute;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * @DiscriminatorMap(
 *     typeProperty="type",
 *     mapping={
 *         "parking_middle" = "App\Objects\Zone\Middle\Parking",
 *         "entrance_middle" = "App\Objects\Zone\Middle\Entrance",
 *         "toilet_middle" = "App\Objects\Zone\Middle\Toilet",
 *         "service_middle" = "App\Objects\Zone\Middle\Service",
 *         "accessibility_middle" = "App\Objects\Zone\Middle\ServiceAccessibility",
 *         "movement_middle" = "App\Objects\Zone\Middle\Movement",
 *         "navigation_middle" = "App\Objects\Zone\Middle\Navigation",
 *         "small" = "App\Objects\Zone\Small\Zone",
 *         "parking_full" = "App\Objects\Zone\Full\Parking",
 *         "entrance_full" = "App\Objects\Zone\Full\Entrance",
 *         "movement_full" = "App\Objects\Zone\Full\Movement",
 *         "service_full" = "App\Objects\Zone\Full\Service",
 *         "toilet_full" = "App\Objects\Zone\Full\Toilet",
 *         "navigation_full" = "App\Objects\Zone\Full\Navigation",
 *         "accessibility_full" = "App\Objects\Zone\Full\ServiceAccessibility",
 * })
 */
abstract class Zone implements DataObject
{
    protected function isMatches(array $keys, Attribute $compare): bool
    {
        foreach ($keys as $key) {
            if (!$this->{'attribute' . $key}->isEqualsTo($compare)) {
                return false;
            }
        }
        return true;
    }

    protected function isMatchesPartial(array $keys, Attribute $compare): bool
    {
        $matches = 0;
        foreach ($keys as $key) {
            if ($this->{'attribute' . $key}->isEqualsTo($compare)) {
                $matches++;
            }
        }
        return $matches > 0 && $matches < count($keys);
    }

    protected function isMatchesAllExcept(array $except, Attribute $compare): bool
    {
        foreach (get_object_vars($this) as $key => $val) {
            if (in_array((int)str_replace('attribute', '', $key), $except)) {
                continue;
            }
            if (!$val->isEqualsTo($compare)) {
                return false;
            }
        }
        return true;
    }

    protected function isMatchesAll(Attribute $compare): bool
    {
        foreach (get_object_vars($this) as $val) {
            if (!$val->isEqualsTo($compare)) {
                return false;
            }
        }
        return true;
    }

    abstract function calculateScore(): AccessibilityScore;
}