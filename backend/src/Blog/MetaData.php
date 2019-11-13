<?php
declare(strict_types=1);

namespace App\Blog;


use App\Infrastructure\ObjectResolver\DataObject;

final class MetaData implements DataObject
{
    /**
     * @var string|null
     */
    public $title;

    /**
     * @var string|null
     */
    public $description;

    /**
     * @var string|null
     */
    public $keywords;

    /**
     * @var string|null
     */
    public $ogTitle;

    /**
     * @var string|null
     */
    public $ogDescription;

    /**
     * @var Image|null
     */
    public $ogImage;
}