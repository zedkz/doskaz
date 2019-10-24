<?php
declare(strict_types=1);

namespace App\Objects;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
final class Point
{
    /**
     * @ORM\Column(type="geography", options={"geometry_type" = "POINT"})
     */
    private $value;

    public static function fromLatLong(string $lat, string $long): self
    {
        $point = new self();
        $point->value = sprintf('POINT(%s %s)', $lat, $long);
        return $point;
    }
}