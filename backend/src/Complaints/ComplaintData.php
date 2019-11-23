<?php
declare(strict_types=1);

namespace App\Complaints;


use App\Infrastructure\ObjectResolver\DataObject;
use Symfony\Component\Validator\Constraints as Assert;

final class ComplaintData implements DataObject
{
    /**
     * @var Complainant
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    public $complainant;

    /**
     * @var string|int|null
     * @Assert\NotBlank()
     */
    public $authorityId;

    /**
     * @var boolean
     */
    public $rememberPersonalData;

    /**
     * @var ComplaintContent
     * @Assert\Valid()
     * @Assert\NotBlank()
     */
    public $content;
}