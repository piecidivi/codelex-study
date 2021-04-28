<?php

namespace App\Services\Login;

use App\Models\User;
use App\Repositories\Users\UserRepository;
use Exception;

class LoginUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws \Exception
     */
    public function getByEmail(string $email, string $password): User
    {
        try {
            $user = $this->userRepository->getByEmail($email);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        try {
            $user->verifyPassword($password);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

        return $user;
    }
}