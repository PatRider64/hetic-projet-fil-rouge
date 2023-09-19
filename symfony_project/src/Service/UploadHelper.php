<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\FilesystemOperator;

class UploadHelper
{
    const MUSIC_SHEET_PATH = 'uploads/music_sheet';
    const DEFAULT_IMAGE_PATH = 'images/image-placeholder.jpg';

    private FilesystemOperator $defaultStorage;

    public function __construct(FilesystemOperator $defaultStorage)
    {
        $this->defaultStorage = $defaultStorage;
    }

    public function uploadMusicSheet(UploadedFile $file): string
    {
        $originalfileName = $file->getFilename();
        $basefileName = pathinfo($originalfileName, PATHINFO_FILENAME);
        $fileName = Urlizer::urlize($basefileName . '-' . uniqid() . '.' . $file->guessExtension());
        
        $stream = fopen($file->getPathName(), 'r');
        $this->defaultStorage->writeStream(
            self::MUSIC_SHEET_PATH . '/' . $fileName,
            $stream
        );

        if (is_resource($stream)) {
            fclose($stream);
        }

        return $fileName;
    }

    public function readStream(string $path)
    {
        return $this->defaultStorage->readStream($path);
    }

    public function fixtureUpload(File $file): string
    {
        $originalfileName = $file->getFilename();
        $basefileName = pathinfo($originalfileName, PATHINFO_FILENAME);
        $fileName = Urlizer::urlize($basefileName . '-' . uniqid() . '.' . $file->guessExtension());
        
        $stream = fopen($file->getPathName(), 'r');
        $this->defaultStorage->writeStream(
            self::MUSIC_SHEET_PATH . '/' . $fileName,
            $stream
        );

        if (is_resource($stream)) {
            fclose($stream);
        }

        return $fileName;
    }
}