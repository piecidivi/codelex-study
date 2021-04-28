<?php

namespace App\Middlewares;

use Bootstrap\Request;

interface MiddlewareInterface
{
    public function handle(Request $request): void;
}