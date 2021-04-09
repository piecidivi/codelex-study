<?php

namespace App\Controllers;

use App\Views\View;

class ErrorController extends Controller
{
    public function fourOFour(): void
    {
        $this->loginMessage = "Page not found! Better start with login. &#128523";
        echo View::output("login.php.twig", [
            'loginMessage' => $this->loginMessage
        ]);
    }

    public function fourOFive(array $allowedMethods): void
    {
        $this->loginMessage = "This method must be from some other planet! Better start with login. &#128523";
        echo View::output("login.php.twig", [
            'loginMessage' => $this->loginMessage
        ]);
    }
}