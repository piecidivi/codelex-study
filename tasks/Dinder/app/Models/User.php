<?php

namespace App\Models;

use ErrorException;
use InvalidArgumentException;
use JsonSerializable;

class User implements JsonSerializable
{
    private int $id;
    private string $email;
    private string $password;
    private string $name;
    private string $sex;
    private string $preference;
    private string $imagePath;
    private string $originalImageName;

    public function __construct(
        string $email,
        string $password,
        int $id = -1,
        string $name = "***",
        string $sex = "",
        string $preference = "",
        string $imagePath = "dummy.jpg",
        string $originalImageName = ""
    )
    {
        $this->id = $id;
        $this->email = strtolower($email);
        $this->password = $password;
        $this->name = $name;
        $this->sex = $sex;
        $this->preference = $preference;
        $this->imagePath = $imagePath;
        $this->originalImageName = $originalImageName;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function sex(): string
    {
        return $this->sex;
    }

    public function preference(): string
    {
        return $this->preference;
    }

    public function imagePath(): string
    {
        return $this->imagePath;
    }

    public function originalImageName(): string
    {
        return $this->originalImageName;
    }

    public function setNewPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @throws \ErrorException
     */
    public function hashPassword(): void
    {
        if (!$password = password_hash($this->password, PASSWORD_DEFAULT)) {
            throw new ErrorException("Password hashing failure.");
        } else {
            $this->password = $password;
        }
    }

    public function verifyPassword(string $password): void
    {
        if (!password_verify($password, $this->password)) {
            throw new InvalidArgumentException("Wrong password.");
        }
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}