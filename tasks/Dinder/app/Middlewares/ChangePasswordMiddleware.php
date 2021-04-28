<?php

namespace App\Middlewares;

use App\Validation\InputValidator;
use Bootstrap\Request;
use InvalidArgumentException;

class ChangePasswordMiddleware implements MiddlewareInterface
{
    public function handle(Request $request): void
    {
        $inputValidator = new InputValidator();

        $required = [
            "poldPassword",
            "pnewPassword",
            "pconfirmNewPassword"
        ];

        $rules = [
            "pconfirmNewPassword" => [
                "password" => [],
                "length" => [
                    "min" => "8",
                    "max" => "20"
                ],
                "match" => [
                    "password" => $request->get()["pnewPassword"]
                ]
            ]
        ];

        try {
            $inputValidator->validate($request->get(), $required, $rules);
        } catch (InvalidArgumentException $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /profile");
            exit();
        }
    }
}