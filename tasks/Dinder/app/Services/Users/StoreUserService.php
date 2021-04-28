<?php

namespace App\Services\Users;

use App\Models\User;
use App\Repositories\Users\UserRepository;
use ErrorException;
use Exception;

class StoreUserService
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
    public function store(string $email, string $password): void
    {
        $user = new User($email, $password);

        try {
            $user->hashPassword();
        } catch (ErrorException $exception) {
            throw new ErrorException($exception->getMessage());
        }

        try {
            $this->userRepository->add($user);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}