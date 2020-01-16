<?php
declare(strict_types=1);

namespace App\Infrastructure\Storage;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Filesystem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
