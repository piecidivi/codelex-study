<?php

namespace App\Services\Users;

use App\Repositories\Users\UserRepository;
use InvalidArgumentException;

class UpdateUserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updateAll(
        int $id,
        string $name,
        string $sex,
        string $preference,
        string $imagePath,
        string $originalImageName): void
    {
        try {
            $this->userRepository->updateUserAll($id, $name, $sex, $preference, $imagePath, $originalImageName);
        } catch (InvalidArgumentException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    public function update(int $id, string $name, string $sex, string $preference): void
    {
        try {
            $this->userRepository->updateUser($id, $name, $sex, $preference);
        } catch (InvalidArgumentException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }
}