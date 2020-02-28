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
 *         "serviceAccessibility_middle" = "App\Objects\Zone\Middle\ServiceAccessibility",
 *         "movement_middle" = "App\Objects\Zone\Middle\Movement",
 *         "navigation_middle" = "App\Objects\Zone\Middle\Navigation",
 *         "small" = "App\Objects\Zone\Small\Zone",
 *         "parking_full" = "App\Objects\Zone\Full\Parking",
 *         "entrance_full" = "App\Objects\Zone\Full\Entrance",
 *         "movement_full" = "App\Objects\Zone\Full\Movement",
 *         "service_full" = "App\Objects\Zone\Full\Service",
 *         "toilet_full" = "App\Objects\Zone\Full\Toilet",
 *         "navigation_full" = "App\Objects\Zone\Full\Navigation",
 *         "serviceAccessibility_full" = "App\Objects\Zone\Full\ServiceAccessibility",
 *         "accessibility_full" = "App\Objects\Zone\Full\ServiceAccessibility",
 * })
 */
abstract class Zone implements DataObject
{
    /**
     * @var AttributesMap
     */
    public $attributes;

    /**
     * @var AccessibilityScore|null
     */
    public $overriddenScore;

    abstract protected static function attributesKeys(): array;

    public function __construct(?AttributesMap $attributes, ?AccessibilityScore $overriddenScore = null)
    {
        $this->attributes = new AttributesMap();
        $this->overriddenScore = $overriddenScore;

        $inputAttributes = $attributes ?? new AttributesMap();

        $defaultAttribute = Attribute::unknown();
        foreach (static::attributesKeys() as $key) {
            $this->attributes->offsetSet($key, $inputAttributes->get($key, $defaultAttribute));
        }
    }

    abstract function calculateScore(): AccessibilityScore;

    public final function accessibilityScore(): AccessibilityScore
    {
        return $this->overriddenScore ?? $this->calculateScore();
    }

    protected function isMatches(array $keys, Attribute $compare): bool
    {
        foreach ($keys as $key) {
            if (!$this->attributes->get('attribute' . $key)->isEqualsTo($compare)) {
                return false;
            }
        }
        return true;
    }


    protected function isMatchesPartial(array $keys, Attribute $compare): bool
    {
        $matches = 0;
        foreach ($keys as $key) {
            if ($this->attributes->get('attribute' . $key)->isEqualsTo($compare)) {
                $matches++;
            }
        }
        return $matches > 0 && $matches < count($keys);
    }

    protected function isMatchesAllExcept(array $except, Attribute $compare): bool
    {
        foreach ($this->attributes as $key => $val) {
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
        foreach ($this->attributes as $val) {
            if (!$val->isEqualsTo($compare)) {
                return false;
            }
        }
        return true;
    }
}