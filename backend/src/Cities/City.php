<?php


namespace App\Cities;

use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;

/**
 * @Schema(title="Город", schema="City")
 */
class City
{
    /**
     * @var int
     * @Property()
     */
    public $id;

    /**
     * @var string
     * @Property()
     */
    public $name;
}
