<?php
declare(strict_types=1);

namespace App\Complaints;

use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;

/**
 * @Schema(title="Жалоба на отсутствие доступа", schema="ComplaintContent2")
 */
final class ComplaintType2 extends ComplaintContent
{
    /**
     * @var boolean
     * @Property(description="Угроза причинения вреда жизни")
     */
    public $threatToLife = false;

    /**
     * @var string|null
     * @Property(description="Другое", nullable=true)
     */
    public $comment;

    /**
     * @var array
     */
    public $options;
}