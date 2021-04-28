<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\MySQLAbstract;
use Exception;
use http\Exception\RuntimeException;
use InvalidArgumentException;

class MySQLUserRepository extends MySQLAbstract implements UserRepository
{

    public function add(User $user): void
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new RuntimeException("No connection to database.");
        }

        $this->database->insert("Users", [
            "email" => $user->email(),
            "password" => $user->password(),
            "name" => $user->name(),
            "sex" => $user->sex(),
            "preference" => $user->preference(),
            "image_path" => $user->imagePath(),
            "original_image_name" => $user->originalImageName()
        ]);

        if ($this->database->id() === null) {
            throw new InvalidArgumentException("E-mail must be unique.");
        }
    }

    public function getByEmail(string $email): User
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new \RuntimeException("No connection to database.");
        }

        $user = $this->database->select("Users", "*", [
            "email" => $email,
            "LIMIT" => 1
        ]);

        if (count($user) < 1) {
            throw new InvalidArgumentException("Wrong email address.");
        }

        return $this->createOneUser($user[0]);
    }

    public function getById(int $id): User
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $user = $this->database->select("Users", "*", [
            "id" => $id,
            "LIMIT" => 1
        ]);

        if (count($user) < 1) {
            throw new InvalidArgumentException("Internal error retrieving user by ID.");
        }

        return $this->createOneUser($user[0]);
    }

    public function updateUserAll(
        int $id,
        string $name,
        string $sex,
        string $preference,
        string $imagePath,
        string $originalImageName): void
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $update = $this->database->update("Users", [
            "name" => $name,
            "sex" => $sex,
            "preference" => $preference,
            "image_path" => $imagePath,
            "original_image_name" => $originalImageName
        ], [
            "id" => $id
        ]);

        if ($update->rowCount() < 1) {
            throw new InvalidArgumentException("User ID not found.");
        }
    }

    public function updateUser(int $id, string $name, string $sex, string $preference): void
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $update = $this->database->update("Users", [
            "name" => $name,
            "sex" => $sex,
            "preference" => $preference
        ], [
            "id" => $id
        ]);

        if ($update->rowCount() < 1) {
            throw new InvalidArgumentException("User ID not found.");
        }
    }

    public function updatePassword(User $user): void
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $update = $this->database->update("Users", [
            "password" => $user->password()
        ], [
            "id" => $user->id()
        ]);

        if ($update->rowCount() < 1) {
            throw new InvalidArgumentException("User ID not found.");
        }
    }

    public function delete(int $id): void
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $delete = $this->database->delete("Users", [
            "id" => $id
        ]);

        if ($delete->rowCount() < 1) {
            throw new InvalidArgumentException("User ID not found.");
        }
    }

    /**
     * @throws \Exception
     */
    public function filterForRatingAll(array $checkedIdCollection, string $sex): User
    {
        // LIMIT 1
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $user = $this->database->select("Users", "*", [
            "AND" => [
                "id[!]" => $checkedIdCollection,
                "preference" => [$sex, "A"]
            ],
            "LIMIT" => 1
        ]);
        if (count($user) < 1) {
            throw new Exception("NOCHECK");
        }

        return $this->createOneUser($user[0]);
    }

    /**
     * @throws \Exception
     */
    public function filterForRatingSpecific(array $checkedIdCollection, string $sex, string $preference): User
    {
        // LIMIT 1
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $user = $this->database->select("Users", "*", [
            "AND" => [
                "id[!]" => $checkedIdCollection,
                "sex" => $preference,
                "preference" => [$sex, "A"]
            ],
            "LIMIT" => 1
        ]);
        if (count($user) < 1) {
            throw new Exception("NOCHECK");
        }

        return $this->createOneUser($user[0]);
    }

    private function createOneUser(array $user): User
    {
        return new User($user["email"], $user["password"],
            $user["id"], $user["name"],
            $user["sex"], $user["preference"],
            $user["image_path"], $user["original_image_name"]);
    }
}