<?php

namespace App\Controllers;

use App\Models\Word;

class HomeController
{
    public function index(): void
    {
        $message = "Welcome to Router task index page.";
        require_once "app/Views/View.php";
    }

    public function postIndex(): void
    {
        if (isset($_POST["submit"])) {
            $word = new Word(trim($_POST["word"]));
            $message = "Did You enter this \"{$word->getChangedWord()}\"? Try again.";
            require_once "app/Views/View.php";
        }
    }
}