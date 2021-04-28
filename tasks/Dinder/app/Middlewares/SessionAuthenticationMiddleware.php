<?php

namespace App\Middlewares;

use Bootstrap\Request;

class SessionAuthenticationMiddleware implements MiddlewareInterface
{
    public function handle(Request $request): void
    {
        if (!isset($_SESSION["userid"])) {
            header("Location: /fourOFour");
            exit();
        }
    }
}