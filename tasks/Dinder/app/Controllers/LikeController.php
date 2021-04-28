<?php

namespace App\Controllers;

use App\Services\Rating\PhotoRatingLoadService;
use App\Services\Rating\PhotoRatingSaveService;
use App\Services\Rating\PhotoResetService;
use App\Services\Users\GetUserService;
use Bootstrap\Request;
use Exception;

class LikeController extends Controller
{
    private PhotoRatingLoadService $photoRatingLoadService;
    private PhotoRatingSaveService $photoRatingSaveService;
    private PhotoResetService $photoResetService;
    private GetUserService $getUserService;

    public function __construct(
        PhotoRatingLoadService $photoRatingLoadService,
        PhotoRatingSaveService $photoRatingSaveService,
        GetUserService $getUserService,
        PhotoResetService $photoResetService
    )
    {
        $this->photoRatingLoadService = $photoRatingLoadService;
        $this->photoRatingSaveService = $photoRatingSaveService;
        $this->getUserService = $getUserService;
        $this->photoResetService = $photoResetService;
    }

    public function like(Request $request): string
    {
        $userid = intval($_SESSION["userid"]);
        $checkedId = intval($_SESSION["checkedId"]);
        $like = $request->get()["poption"];

        // Save activity
        try {
            $this->photoRatingSaveService->save($userid, $checkedId, $like);
        } catch (Exception $exception) {
            $this->tableMessage = $exception->getMessage();
            header("Location: /home");
            exit();
        }

        // Get user to filter preferences
        try {
            $user = $this->getUserService->getById($userid);
        } catch (Exception $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /logout");
            exit();
        }

        // Load picture to check and history
        try {
            $rating = $this->photoRatingLoadService->load($user->id(), $user->sex(), $user->preference());
        } catch (Exception $exception) {
            $this->controlMessage = $exception->getMessage();
            header("Content-type: application/json");
            return json_encode(["controlMessage" => $this->controlMessage]);
        }

        // Use id from session to save checked user info, so that bad boys do not tamper with posted id.
        $_SESSION["checkedId"] = $rating["checkUser"]->id();
        $this->controlMessage = "NONE";

        header("Content-type: application/json");
        return json_encode([
            "controlMessage" => $this->controlMessage,
            "checkUser" => $rating["checkUser"]->jsonSerialize(),
            "history" => $rating["history"]->serialize()
        ]);
    }

    public function reset(): void
    {
        $id = intval($_SESSION["userid"]);
        try {
            $this->photoResetService->resetHistory($id);
        } catch (Exception $exception) {
            $this->tableMessage = $exception->getMessage();
            header("Location: /home");
        }
        header("Location: /home");
    }
}