<?php

namespace App\Controllers;

use App\Services\Tokens\TokenService;
use App\Views\View;
use Exception;

class LoginController extends Controller
{
    private TokenService $token;

    public function __construct(TokenService $token)
    {
        $this->token = $token;
    }

    public function access(): void
    {
        $this->loginMessage = "&nbsp;";

        if (empty($_GET)) {
            $this->loginMessage = "Something went wrong. Please try again.";
            echo View::output("login.php.twig", [
                'loginMessage' => $this->loginMessage
            ]);
            return;
        }

        $personalCode = trim($_GET["personalCode"]);
        $time = mktime();

        if (!$this->validatePersonalCode($personalCode)) {
            $this->loginMessage = "Invalid code for login provided. Try something better. &#128523";
            echo View::output("login.php.twig", [
                'loginMessage' => $this->loginMessage
            ]);
            return;
        }

        try {
            $this->loginMessage = $this->token->createToken($personalCode, $time);
        } catch (Exception $exception) {
            $this->loginMessage = $exception->getMessage();
            echo View::output("login.php.twig", [
                'loginMessage' => $this->loginMessage
            ]);
            return;
        }

        $this->loginMessage = "Please use this link to access system: " . $this->loginMessage;
        echo View::output("login.php.twig", [
            'loginMessage' => $this->loginMessage
        ]);
    }

    public function login(): void
    {
        if (empty($_GET)) {
            $this->loginMessage = "Something went wrong. Please try again.";
            echo View::output("login.php.twig", [
                'loginMessage' => $this->loginMessage
            ]);
            return;
        }

        $token = trim($_GET["token"]);
        $time = mktime();

        try {
            $person = $this->token->validateToken($token, $time);
        } catch (Exception $exception) {
            $this->loginMessage = $exception->getMessage();
            echo View::output("login.php.twig", [
                'loginMessage' => $this->loginMessage
            ]);
            return;
        }

        $_SESSION["userid"] = $person->id();

        $this->tableLayout = self::TABLE_LAYOUT_INIT;
        $this->tableMessage = "&nbsp;";
        echo View::output("home.php.twig", [
            'tableMessage' => $this->tableMessage,
            'tableLayout' => $this->tableLayout
        ]);
    }

    public function logout(): void
    {
        if ($_SESSION["userid"]) unset($_SESSION["userid"]);

        $this->loginMessage = "Thanks for playing with us. Start all over again.";
        echo View::output("login.php.twig", [
            'loginMessage' => $this->loginMessage
        ]);
    }
}