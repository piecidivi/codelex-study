<?php

namespace App\Controllers;

use App\Services\Login\LoginUserService;
use Bootstrap\Request;
use Bootstrap\View;
use Exception;

class LoginController extends Controller
{
    private LoginUserService $loginUserService;

    public function __construct(LoginUserService $loginUserService)
    {
        $this->loginUserService = $loginUserService;
    }

    public function index(): string
    {
        $this->tableMessage = "&nbsp;";
        if (isset($_SESSION["_flash"])) {
            $this->tableMessage = $_SESSION["_flash"];
        }

        return View::output("login.php.twig", [
            "tableMessage" => $this->tableMessage
        ]);
    }

    public function login(Request $request): void
    {
        try {
            $user = $this->loginUserService->getByEmail($request->get()["pemail"], $request->get()["ppassword"]);
            $_SESSION["userid"] = $user->id();
            $_SESSION["user_name"] = $user->name();
        } catch (Exception $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /");
            return;
        }

        header("Location: /home");
    }

    public function logout(): void
    {
        if (isset($_SESSION["userid"])) {
            unset($_SESSION["userid"]);
        }
        if (isset($_SESSION["user_name"])) {
            unset($_SESSION["user_name"]);
        }
        header("Location: /");
    }
}