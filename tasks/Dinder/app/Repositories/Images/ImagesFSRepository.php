<?php

namespace App\Repositories\Images;

use Intervention\Image\Exception\NotWritableException;
use Intervention\Image\ImageManager;

class ImagesFSRepository implements ImagesRepository
{
    private ImageManager $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(array("driver" => "imagick"));
    }

    public function save(array $fileContents): string
    {
        $image = $this->imageManager->make($fileContents["tmp_name"]);

        $image->resize(null, 384, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        // Path and filename here
        $extension = pathinfo($fileContents["name"], PATHINFO_EXTENSION);
        $path = $this->saveImagePath();
        $fullPath = "{$path["fullPath"]}.{$extension}";
        $symlinkPath = "{$path["symlinkPath"]}.{$extension}";

        try {
            $image->save($fullPath);
        } catch (NotWritableException $exception) {
            throw new NotWritableException($exception->getMessage());
        }
        return $symlinkPath;
    }

    public function delete(string $symlinkPath): void
    {
        $paths = $this->deleteImagePath($symlinkPath);
        unlink($paths["fullPath"]);
        if (count(glob($paths["dir2"] . "/*")) === 0) {
            rmdir($paths["dir2"]);
        }
        if (count(glob($paths["dir1"] . "/*")) === 0) {
            rmdir($paths["dir1"]);
        }
    }

    private function saveImagePath(): array
    {
        $unique = uniqid();
        $pathDir = $_ENV["STORAGE_PATH"] . "storage/pictures/";
        $shareDir = "pictures/";
        $uniqueDir1 = substr($unique, 0, 3);
        $uniqueDir2 = substr($unique, 3, 3);
        $makeDir1 = "{$pathDir}{$uniqueDir1}";
        $makeDir2 = "{$pathDir}{$uniqueDir1}/{$uniqueDir2}";
        $fullPath = "{$pathDir}{$uniqueDir1}/{$uniqueDir2}/{$unique}";
        $symlinkPath = "{$shareDir}{$uniqueDir1}/{$uniqueDir2}/{$unique}";

        if (!file_exists($makeDir1)) {
            mkdir($makeDir1);
        };

        if (!file_exists($makeDir2)) {
            mkdir($makeDir2);
        };

        return [
            "symlinkPath" => $symlinkPath,
            "fullPath" => $fullPath
        ];
    }

    private function deleteImagePath(string $symlinkPath): array
    {
        $parts = explode("/", $symlinkPath);
        $rootPath = $_ENV["STORAGE_PATH"] . "storage/";
        $fullPath = $rootPath . $symlinkPath;  // unlink file
        $dir2 = $rootPath . "/" . $parts[0] . "/" . $parts[1] . "/" . $parts[2];
        $dir1 = $rootPath . "/" . $parts[0] . "/" . $parts[1];

        return [
            "fullPath" => $fullPath,
            "dir1" => $dir1,
            "dir2" => $dir2
        ];
    }
}