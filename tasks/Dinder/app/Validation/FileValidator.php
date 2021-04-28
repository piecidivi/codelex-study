<?php

namespace App\Validation;

use ErrorException;
use Intervention\Image\Exception\ImageException;
use Intervention\Image\ImageManager;

class FileValidator
{
    private ImageManager $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(array("driver" => "imagick"));
    }

    private array $uploadErrors = [
        UPLOAD_ERR_OK => "There is no error.",
        UPLOAD_ERR_INI_SIZE => "File bigger than 2 MB.",
        UPLOAD_ERR_FORM_SIZE => "File bigger than 2 MB.",
        UPLOAD_ERR_PARTIAL => "File upload error. Please try again.",
        UPLOAD_ERR_NO_FILE => "File upload error. Please try again.",
        UPLOAD_ERR_NO_TMP_DIR => "Temporary storage error. Please try again.",
        UPLOAD_ERR_CANT_WRITE => "Storage error. Please try again.",
        UPLOAD_ERR_EXTENSION => "File upload error. Please try again."
    ];

    /**
     * @throws ErrorException
     */
    public function validate(array $file): void
    {
        $this->checkUploadErrors($file["error"]);
        $this->checkMimes($file["tmp_name"]);
    }

    /**
     * @throws ErrorException
     */
    private function checkUploadErrors(int $error): void
    {
        if ($error !== 0) {
            throw new ErrorException($this->uploadErrors[$error]);
        }
    }

    private function checkMimes(string $tempName): void
    {
        try {
            $this->imageManager->make($tempName)->mime();
        } catch (ImageException $exception) {
            throw new ImageException("Please select pictures only!");
        }
    }
}