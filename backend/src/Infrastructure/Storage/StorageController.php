<?php
declare(strict_types=1);

namespace App\Infrastructure\Storage;

use App\Blog\Image;
use League\Flysystem\AdapterInterface;
use League\Flysystem\Filesystem;
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
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @Route(path="/upload", methods={"POST"})
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function upload(Request $request)
    {
        $filesystem = new Filesystem($this->adapter);
        $name = bin2hex(random_bytes(16));
        $filesystem->assertAbsent($name);
        $filesystem->writeStream($name, $request->getContent(true));

        return [
            'path' => "/storage/{$name}"
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
