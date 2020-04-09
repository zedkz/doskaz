<?php
declare(strict_types=1);

namespace App\Infrastructure\Storage;

use App\Blog\Image;
use Hoa\Mime\Mime;
use League\Flysystem\FilesystemInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 * @Route(path="/api/storage")
 */
final class StorageController extends AbstractController
{
    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    public function __construct(FilesystemInterface $defaultStorage)
    {
        //   $this->adapter = $adapter;
        $this->filesystem = $defaultStorage;
    }

    /**
     * @Route(path="/upload", methods={"POST"})
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function upload(Request $request)
    {
        $name = bin2hex(random_bytes(16));
        $this->filesystem->assertAbsent($name);

        $this->filesystem->writeStream($name, $request->getContent(true));


        $mime = $this->filesystem->getMimetype($name);

        $extensions = Mime::getExtensionsFromMime($mime);
        $nameWithExtension = $name.'.'.$extensions[0];
        $this->filesystem->rename($name, $nameWithExtension);

        return [
            'path' => "/storage/{$nameWithExtension}"
        ];
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route(path="/preview/{imagePath}", requirements={"imagePath" = ".+"})
     * @param $imagePath
     * @param Request $request
     * @return RedirectResponse
     */
    public function preview($imagePath, Request $request)
    {
        $img = new Image();
        $img->image = $imagePath;

        if ($request->query->has('x')) {
            $img->cropData = [
                'x' => $request->query->getInt('x'),
                'y' => $request->query->getInt('y'),
                'width' => $request->query->getInt('width'),
                'height' => $request->query->getInt('height'),
            ];
        }
        return $this->redirect($img->resize(200, 0));
    }
}
