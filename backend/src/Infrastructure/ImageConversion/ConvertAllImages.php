<?php


namespace App\Infrastructure\ImageConversion;


use League\Flysystem\FilesystemInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class ConvertAllImages extends Command
{
    private MessageBusInterface $messageBus;

    private FilesystemInterface $defaultStorage;

    public function __construct(MessageBusInterface $messageBus, FilesystemInterface $defaultStorage)
    {
        parent::__construct();
        $this->messageBus = $messageBus;
        $this->defaultStorage = $defaultStorage;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $files = $this->defaultStorage->listContents('', true);
        foreach ($files as $file) {
            $mime = $this->defaultStorage->getMimetype($file['path']);
            if (!str_starts_with($mime, 'image')) {
                continue;
            }
            $this->messageBus->dispatch(new ImageConversion($file['path']));
        }
    }
}