<?php

namespace App\Controllers;

use App\Views\View;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->loginMessage = "&nbsp;";

        echo View::output("login.php.twig", [
            'loginMessage' => $this->loginMessage
        ]);
    }

    public function home(): void
    {
        if (!$_SESSION["userid"]) {
            $this->loginMessage = "Please log in first.";
            echo View::output("login.php.twig", [
                'loginMessage' => $this->loginMessage
            ]);
            return;
        }

        $this->tableLayout = self::TABLE_LAYOUT_INIT;
        $this->tableMessage = "&nbsp;";
        echo View::output("home.php.twig", [
            'tableMessage' => $this->tableMessage,
            'tableLayout' => $this->tableLayout
        ]);
    }
}