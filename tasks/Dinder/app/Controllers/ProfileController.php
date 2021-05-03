<?php

namespace App\Controllers;

use App\Services\Images\ImageDeleteService;
use App\Services\Images\ImageSaveService;
use App\Services\Users\ChangePasswordService;
use App\Services\Users\DeleteUserService;
use App\Services\Users\GetUserService;
use App\Services\Users\UpdateUserService;
use Bootstrap\Request;
use Bootstrap\View;
use Exception;
use Intervention\Image\Exception\NotWritableException;
use InvalidArgumentException;

class ProfileController extends Controller
{
    private GetUserService $getUserService;
    private DeleteUserService $deleteUserService;
    private ChangePasswordService $changePasswordService;
    private ImageSaveService $imageUploadService;
    private ImageDeleteService $imageDeleteService;
    private UpdateUserService $updateUserService;

    public function __construct(
        GetUserService $getUserService,
        DeleteUserService $deleteUserService,
        ChangePasswordService $changePasswordService,
        ImageSaveService $imageUploadService,
        ImageDeleteService $imageDeleteService,
        UpdateUserService $updateUserService
    )
    {
        $this->getUserService = $getUserService;
        $this->deleteUserService = $deleteUserService;
        $this->changePasswordService = $changePasswordService;
        $this->imageUploadService = $imageUploadService;
        $this->imageDeleteService = $imageDeleteService;
        $this->updateUserService = $updateUserService;
    }

    public function profile(): string
    {
        $this->tableMessage = "&nbsp;";
        if (isset($_SESSION["_flash"])) {
            $this->tableMessage = $_SESSION["_flash"];
        }
        $id = intval($_SESSION["userid"]);

        try {
            $profile = $this->getUserService->getById($id);
        } catch (Exception $exception) {
            $this->tableMessage = $exception->getMessage();
            return View::output("home.php.twig", [
                "userName" => $_SESSION["user_name"],
                "tableMessage" => $this->tableMessage
            ]);
        }

        return View::output("profile.php.twig", [
            "userName" => $_SESSION["user_name"],
            "tableMessage" => $this->tableMessage,
            "profile" => $profile->jsonSerialize()
        ]);
    }

    public function update(Request $request): void
    {
        // If new/refresh picture uploaded, save picture and data
        if ($request->getFile()["error"] !== 4) {

            // 1. Get user to delete old picture
            $pid = intval($request->getInput()["pid"]);

            try {
                $profile = $this->getUserService->getById($pid);
            } catch (Exception $exception) {
                $_SESSION["_flash"] = $exception->getMessage();
                header("Location: /profile");
                return;
            }

            // 2. Save new picture and get symlink path to save to user
            try {
                $symlinkPath = $this->imageUploadService->upload($request->getFile());
            } catch (NotWritableException $exception) {
                $_SESSION["_flash"] = $exception->getMessage();
                header("Location: /profile");
                return;
            }

            // 3. After saving new picture is success, delete old.
            $this->imageDeleteService->deleteImage($profile->imagePath());

            // 4. Update user data along with new symlinkPath
            try {
                $this->updateUserService
                    ->updateAll(intval($request->getInput()["pid"]),
                        $request->getInput()["pname"],
                        $request->getInput()["psex"],
                        $request->getInput()["ppreference"],
                        $symlinkPath,
                        $request->getFile()["name"]
                    );
            } catch (Exception $exception) {
                $_SESSION["_flash"] = $exception->getMessage();
                header("Location: /profile");
                return;
            }

            // If data updated without change to picture, save data only
        } else {
            try {
                $this->updateUserService
                    ->update(intval($request->getInput()["pid"]),
                        $request->getInput()["pname"],
                        $request->getInput()["psex"],
                        $request->getInput()["ppreference"]
                    );
            } catch (Exception $exception) {
                $_SESSION["_flash"] = $exception->getMessage();
                header("Location: /profile");
                return;
            }
        }

        $_SESSION["_flash"] = "Update success!";
        header("Location: /profile");
    }

    public function password(Request $request): void
    {
        $pid = intval($request->getInput()["pid"]);
        try {
            $profile = $this->getUserService->getById($pid);
        } catch (Exception $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /profile");
            exit();
        }
        $oldPassword = $request->getInput()["poldPassword"];
        $newPassword = $request->getInput()["pnewPassword"];

        try {
            $this->changePasswordService->changeUserPassword($profile, $oldPassword, $newPassword);
        } catch (Exception $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /profile");
            exit();
        }

        $_SESSION["_flash"] = "Password changed!";
        header("Location: /profile");
    }

    public function delete(Request $request): void
    {
        // Get user
        $id = intval($_SESSION["userid"]);

        try {
            $user = $this->getUserService->getById($id);
        } catch (Exception $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /profile");
            return;
        }

        // Delete picture if exists
        if ($user->imagePath() !== "dummy.jpg") {
            $this->imageDeleteService->deleteImage($user->imagePath());
        }

        // Delete user
        $pid = intval($request->getInput()["pid"]);
        try {
            $this->deleteUserService->deleteUser($pid);
        } catch (InvalidArgumentException $exception) {
            $_SESSION["_flash"] = $exception->getMessage();
            header("Location: /profile");
            return;
        }

        if (isset($_SESSION["userid"])) {
            unset($_SESSION["userid"]);
        }
        header("Location: /");
    }
}