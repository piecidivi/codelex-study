<?php

namespace App\Repositories\Images;

interface ImagesRepository
{
    public function save(array $fileContents): string;

    public function delete(string $symlinkPath): void;
}