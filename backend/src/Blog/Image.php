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

    private function initPipeline()
    {
        if ($this->cropData) {
            return [
                [
                    'operation' => 'extract',
                    'params' => [
                        'quality' => 100,
                        'top' => $this->cropData['y'],
                        'left' => $this->cropData['x'],
                        'areawidth' => $this->cropData['width'],
                        'areaheight' => $this->cropData['height'],
                    ]
                ]
            ];
        }
        return [];
    }

    public function link()
    {
        $pipeline = $this->initPipeline();
        if (count($pipeline)) {
            return "/pipeline?" . http_build_query([
                    'file' => $this->image,
                    'operations' => json_encode($pipeline),
                ]);
        }
        return $this->image;
    }

    public function fit(int $width, int $height)
    {
        $pipeline = $this->initPipeline();
        $pipeline[] = [
            'operation' => 'fit',
            'params' => [
                'width' => $width,
                'height' => $height
            ]
        ];
        return "/pipeline?" . http_build_query([
                'file' => $this->image,
                'operations' => json_encode($pipeline),
            ]);
    }

    public function resize(int $width, ?int $height = null)
    {
        $pipeline = $this->initPipeline();

        $operation = [
            'operation' => 'resize',
            'params' => [
                'quality' => 100,
                'width' => $width,
            ]
        ];

        if ($height) {
            $operation['params']['height'] = $height;
        }

        $pipeline[] = $operation;
        return "/pipeline?" . http_build_query([
                'file' => $this->image,
                'operations' => json_encode($pipeline),
            ]);
    }
}