<?php


namespace App\Infrastructure;


class FileReference
{
    /**
     * @var string
     */
    public $relativePath;

    public function __toString()
    {
        return 'storage/' . $this->relativePath;
    }

    public function link()
    {
        return '/storage/' . $this->relativePath;
    }

    public function __construct($path)
    {
        $this->relativePath = str_replace('/storage/', '', $path);
    }
}