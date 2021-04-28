<?php

namespace App\Middlewares;

use App\Validation\InputValidator;
use Bootstrap\Request;
use InvalidArgumentException;

class SignUpMiddleware implements MiddlewareInterface
{
    public function handle(Request $request): void
    {
        $inputValidator = new InputValidator();

        $required = [
            "pemail",
            "ppassword",
            "pconfirmPassword"
        ];

        $rules = [
            "pemail" => [
                "email" => []
            ],
            "pconfirmPassword" => [
                "password" => [],
                "length" => [
                    "min" => "8",
                    "max" => "20"
                ],
                "match" => [
                    "password" => $request->get()["ppassword"]
                ]
            ]
        ];

        try {
            $inputValidator->validate($request->get(), $required, $rules);
        } catch (InvalidArgumentException $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /");
            exit();
        }
    }
}