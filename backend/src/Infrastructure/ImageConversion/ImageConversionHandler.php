<?php


namespace App\Infrastructure\ImageConversion;


use Intervention\Image\Constraint;
use Intervention\Image\ImageManager;
use League\Flysystem\FilesystemInterface;
use Psr\Log\LoggerInterface;
use Spatie\ImageOptimizer\OptimizerChain;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ImageConversionHandler implements MessageHandlerInterface
{
    private LoggerInterface $logger;

    private FilesystemInterface $filesystem;

    private ImageManager $manager;

    private OptimizerChain $optimizer;

    public function __construct(LoggerInterface $logger, FilesystemInterface $defaultStorage)
    {
        $this->logger = $logger;
        $this->filesystem = $defaultStorage;
        $this->manager = new ImageManager(['driver' => 'imagick']);
        $this->optimizer = OptimizerChainFactory::create();
    }

    public function __invoke(ImageConversion $message)
    {
        if (!$this->filesystem->has($message->path)) {
            $this->logger->warning(sprintf('File path "%s" not found', $message->path));
            return;
        }

        $tempName = '/tmp/' . $message->path;

        $this->manager->make($this->filesystem->readStream($message->path))
            ->orientate()
            ->resize(1920, 1920, function (Constraint $constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($tempName);

        $this->optimizer->optimize($tempName);

        $imageBackupName = $message->path . '.back';

        $file = fopen($tempName, 'r');

        $this->filesystem->copy($message->path, $imageBackupName);
        try {
            $this->filesystem->updateStream($message->path, $file);
            $this->filesystem->delete($imageBackupName);
        } catch (\Throwable $exception) {
            $this->filesystem->delete($message->path);
            $this->filesystem->rename($imageBackupName, $message->path);
            throw $exception;
        } finally {
            fclose($file);
            @unlink($tempName);
        }
    }
}