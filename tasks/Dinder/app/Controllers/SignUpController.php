<?php

namespace App\Controllers;

use App\Services\Login\LoginUserService;
use App\Services\Users\StoreUserService;
use Bootstrap\Request;
use Bootstrap\View;
use Exception;

class SignUpController extends Controller
{
    private StoreUserService $storeUserService;
    private LoginUserService $loginUserService;

    public function __construct(StoreUserService $storeUserService, LoginUserService $loginUserService)
    {
        $this->storeUserService = $storeUserService;
        $this->loginUserService = $loginUserService;
    }

    public function signup(Request $request): void
    {
        try {
            $this->storeUserService->store($request->getInput()["pemail"], $request->getInput()["ppassword"]);
        } catch (Exception $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /");
            return;
        }

        try {
            $user = $this->loginUserService->getByEmail($request->getInput()["pemail"], $request->getInput()["ppassword"]);
            $_SESSION["userid"] = $user->id();
        } catch (Exception $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /");
            return;
        }
        header("Location: /home");
    }
}