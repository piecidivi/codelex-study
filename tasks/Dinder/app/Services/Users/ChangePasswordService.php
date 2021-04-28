<?php

namespace App\Services\Users;

use App\Models\User;
use App\Repositories\Users\UserRepository;
use ErrorException;
use Exception;
use InvalidArgumentException;

class ChangePasswordService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws \ErrorException
     * @throws \Exception
     */
    public function changeUserPassword(User $user, string $oldPassword, string $password): void
    {
        try {
            $user->verifyPassword($oldPassword);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        $user->setNewPassword($password);

        try {
            $user->hashPassword();
        } catch (ErrorException $exception) {
            throw new ErrorException($exception->getMessage());
        }

        try {
            $this->userRepository->updatePassword($user);
        } catch (InvalidArgumentException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
}