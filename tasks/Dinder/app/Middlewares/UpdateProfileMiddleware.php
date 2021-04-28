<?php

namespace App\Middlewares;

use App\Validation\FileValidator;
use App\Validation\InputValidator;
use Bootstrap\Request;
use Exception;
use InvalidArgumentException;

class UpdateProfileMiddleware implements MiddlewareInterface
{
    public function handle(Request $request): void
    {
        // Handle name input
        $inputValidator = new InputValidator();

        $required = [
            "pname",
            "psex",
            "ppreference"
        ];

        $rules = [
            "pname" => [
                "name" => []
            ],
            "psex" => [
                "key" => ["M", "F"]
            ],
            "ppreference" => [
                "key" => ["M", "F", "A"]
            ]
        ];

        try {
            $inputValidator->validate($request->get(), $required, $rules);
        } catch (InvalidArgumentException $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /profile");
            exit();
        }

        // Handle file upload
        if ($request->getImage()["error"] !== 4) {
            $fileValidator = new FileValidator();
            try {
                $fileValidator->validate($request->getImage());
            } catch (Exception $exception) {
                $_SESSION["_flash"] = $exception->getMessage();
                header("Location: /profile");
                exit();
            }
        }
    }
}