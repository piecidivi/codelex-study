<?php

namespace App\Middlewares;

use Bootstrap\Request;

class DataModificationIntegrityMiddleware implements MiddlewareInterface
{
    public function handle(Request $request): void
    {
        $pid = intval($request->getInput()["pid"]);
        if ($pid !== $_SESSION["userid"]) {
            unset($_SESSION["userid"]);
            $_SESSION["_flash"] = "Please do not tamper with user data!";
            header("Location: /");
            exit();
        }
    }
}