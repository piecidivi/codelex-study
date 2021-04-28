<?php

namespace App\Controllers;

use App\Models\HistoryCollection;
use App\Services\Rating\PhotoRatingLoadService;
use App\Services\Users\GetUserService;
use Bootstrap\View;
use Exception;

class HomeController extends Controller
{
    private GetUserService $getUserService;
    private PhotoRatingLoadService $photoRatingLoadService;

    public function __construct(GetUserService $getUserService, PhotoRatingLoadService $photoRatingLoadService)
    {
        $this->getUserService = $getUserService;
        $this->photoRatingLoadService = $photoRatingLoadService;
    }

    public function home(): string
    {
        // Get user
        $userid = intval($_SESSION["userid"]);

        try {
            $user = $this->getUserService->getById($userid);
        } catch (Exception $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /logout");
            exit();
        }

        // Check if name and picture set
        if ($user->name() === "***" && $user->imagePath() === "dummy.jpg") {
            $this->controlMessage = "SETPROFILE";
            return View::output("home.php.twig", [
                "userName" => $_SESSION["user_name"],
                "controlMessage" => $this->controlMessage
            ]);
        }

        // Load picture to check and history
        try {
            $rating = $this->photoRatingLoadService->load($user->id(), $user->sex(), $user->preference());
        } catch (Exception $exception) {
            $this->controlMessage = $exception->getMessage();
            return View::output("home.php.twig", [
                "userName" => $_SESSION["user_name"],
                "controlMessage" => $this->controlMessage
            ]);
        }

        // Use id from session to save checked user info, so that bad boys do not tamper with posted id.
        $_SESSION["checkedId"] = $rating["checkUser"]->id();
        $this->controlMessage = "NONE";
        return View::output("home.php.twig", [
            "userName" => $_SESSION["user_name"],
            "controlMessage" => $this->controlMessage,
            "checkUser" => $rating["checkUser"]->jsonSerialize(),
            "history" => $rating["history"]->serialize()
        ]);
    }
}