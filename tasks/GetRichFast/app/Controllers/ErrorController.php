<?php

namespace App\Controllers;

use App\Views\View;

class ErrorController extends Controller
{
    public function fourOFour(): string
    {
        $this->tableMessage = "Page not found! &#128523";
        return View::output("home.php.twig", [
            "tableMessage" => $this->tableMessage,
        ]);
    }

    public function fourOFive(): string
    {
        $this->tableMessage = "This method must be from some other planet! &#128523";
        return View::output("home.php.twig", [
            "tableMessage" => $this->tableMessage,
        ]);
    }
}