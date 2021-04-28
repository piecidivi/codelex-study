<?php

namespace App\Services\Users;

use App\Repositories\Users\UserRepository;
use InvalidArgumentException;

class DeleteUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function deleteUser(int $id): void
    {
        try {
            $this->userRepository->delete($id);
        } catch (InvalidArgumentException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
}