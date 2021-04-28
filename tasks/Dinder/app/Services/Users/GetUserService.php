<?php

namespace App\Services\Users;

use App\Models\User;
use App\Repositories\Users\UserRepository;
use Exception;

class GetUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws \Exception
     */
    public function getById(int $id): User
    {
        try {
            $user = $this->userRepository->getById($id);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
        return $user;
    }
}