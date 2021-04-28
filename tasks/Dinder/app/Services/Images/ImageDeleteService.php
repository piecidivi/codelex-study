<?php

namespace App\Services\Images;

use App\Repositories\Images\ImagesRepository;

class ImageDeleteService
{
    private ImagesRepository $imagesRepository;

    public function __construct(ImagesRepository $imagesRepository)
    {
        $this->imagesRepository = $imagesRepository;
    }

    public function deleteImage(string $symlinkPath): void
    {
        $this->imagesRepository->delete($symlinkPath);
    }
}