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

    public function link() {
        if ($this->cropData) {
            return "/image/extract?" . http_build_query([
                    'file' => $this->image,
                    'top' => $this->cropData['y'],
                    'left' => $this->cropData['x'],
                    'areawidth' => $this->cropData['width'],
                    'areaheight' => $this->cropData['height'],
                ]);
        } return $this->image;
    }
}