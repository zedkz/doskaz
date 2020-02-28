<?php
declare(strict_types=1);

namespace App\Complaints;

use App\Infrastructure\ObjectResolver\DataObject;
use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Schema(title="Жалоба", schema="Complaint")
 */
final class ComplaintData implements DataObject
{
    /**
     * @var Complainant
     * @Assert\Valid()
     * @Assert\NotBlank()
     * @Property(ref="#/components/schemas/Complainant")
     */
    public $complainant;

    /**
     * @Property(nullable=false, type={"string"}, description="Id органа обращения")
     * @var string|int|null
     * @Assert\NotBlank()
     */
    public $authorityId;

    /**
     * @var boolean
     * @Property(nullable=false, default=false, description="Запомнить данные для дальнейшего использования")
     */
    public $rememberPersonalData = false;

    /**
     * @var ComplaintContent
     * @Assert\Valid()
     * @Assert\NotBlank()
     * @Property(ref="#/components/schemas/AbstractComplaintContent")
     */
    public $content;
}
