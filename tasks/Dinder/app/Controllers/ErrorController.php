<?php

namespace App\Controllers;

use Bootstrap\View;

class ErrorController extends Controller
{
    public function fourOFour(): string
    {
        $this->tableMessage = "Page not found! &#128523";
        return View::output("login.php.twig", [
            "tableMessage" => $this->tableMessage,
        ]);
    }

    public function fourOFive(): string
    {
        $this->tableMessage = "Page not found! &#128523";
        return View::output("login.php.twig", [
            "tableMessage" => $this->tableMessage,
        ]);
    }
}