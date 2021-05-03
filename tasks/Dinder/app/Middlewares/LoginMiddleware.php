<?php

namespace App\Middlewares;

use App\Validation\InputValidator;
use Bootstrap\Request;
use InvalidArgumentException;

class LoginMiddleware implements MiddlewareInterface
{
    public function handle(Request $request): void
    {
        $inputValidator = new InputValidator();

        $required = [
            "pemail",
            "ppassword"
        ];

        $rules = [
            "pemail" => [
                "email" => []
            ]
        ];

        try {
            $inputValidator->validate($request->getInput(), $required, $rules);
        } catch (InvalidArgumentException $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /");
            exit();
        }
    }
}