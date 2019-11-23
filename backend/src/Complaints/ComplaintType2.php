<?php
declare(strict_types=1);

namespace App\Complaints;


final class ComplaintType2 extends ComplaintContent
{
    /**
     * @var boolean
     */
    public $threatToLife = false;

    /**
     * @var string|null
     */
    public $comment;
}