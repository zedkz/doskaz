<?php
declare(strict_types=1);

namespace App\Blog;

use Goodwix\DoctrineJsonOdm\Annotation\ODM;

/**
 * @ODM()
 */
final class Image
{
    /**
     * @var string
     */
    public $image;

    /**
     * @var array
     */
    public $cropData = [];

    /**
     * @var string
     */
    public $name;
}