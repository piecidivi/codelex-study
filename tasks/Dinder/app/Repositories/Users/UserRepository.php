<?php

namespace App\Repositories\Users;

use App\Models\User;

interface UserRepository
{
    public function add(User $user): void;

    public function getByEmail(string $email): User;

    public function getById(int $id): User;

    public function updateUserAll(
        int $id,
        string $name,
        string $sex,
        string $preference,
        string $imagePath,
        string $originalImageName): void;

    public function updateUser(int $id, string $name, string $sex, string $preference): void;

    public function updatePassword(User $user): void;

    public function delete(int $id): void;

    public function filterForRatingAll(array $checkedIdCollection, string $sex): User;

    public function filterForRatingSpecific(array $checkedIdCollection, string $sex, string $preference): User;
}