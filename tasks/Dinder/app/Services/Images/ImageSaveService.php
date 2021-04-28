<?php

namespace App\Services\Images;

use App\Repositories\Images\ImagesRepository;
use Intervention\Image\Exception\NotWritableException;

class ImageSaveService
{
    private ImagesRepository $imagesRepository;

    public function __construct(ImagesRepository $imagesRepository)
    {
        $this->imagesRepository = $imagesRepository;
    }

    public function upload(array $fileContents): string
    {
        try {
            $symlinkPath = $this->imagesRepository->save($fileContents);
        } catch (NotWritableException $exception) {
            throw new NotWritableException($exception->getMessage());
        }
        return $symlinkPath;
    }
}