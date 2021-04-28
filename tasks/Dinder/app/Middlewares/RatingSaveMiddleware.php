<?php

namespace App\Middlewares;

use App\Validation\InputValidator;
use Bootstrap\Request;
use InvalidArgumentException;

class RatingSaveMiddleware implements MiddlewareInterface
{
    public function handle(Request $request): void
    {
        $inputValidator = new InputValidator();

        $required = [
            "poption"
        ];

        $rules = [
            "poption" => [
                "key" => ["yes", "no"]
            ]
        ];

        try {
            $inputValidator->validate($request->get(), $required, $rules);
        } catch (InvalidArgumentException $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /home");
            exit();
        }
    }
}