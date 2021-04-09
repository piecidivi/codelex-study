<?php

namespace App\Models;

use InvalidArgumentException;

class Person
{
    private ?int $id;
    private string $personalCode;
    private string $firstName;
    private string $lastName;
    private string $age;
    private string $address;
    private string $description;

    public function __construct(
        string $personalCode,
        string $firstName,
        string $lastName,
        string $age,
        string $address,
        string $description = null,
        int $id = null
    )

    {
        $this->id = $id;
        $this->setPersonalCode($personalCode);
        $this->firstName = $this->capitalizeName($firstName);
        $this->setLastName($lastName);
        $this->setAge($age);
        $this->address = $address;
        $this->setDescription($description);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function personalCode(): string
    {
        return $this->personalCode;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function age(): string
    {
        return $this->age;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function description(): string
    {
        return $this->description;
    }

    private function setPersonalCode(string $personalCode): void
    {
        if ((strlen($personalCode) === 12 && substr($personalCode, 6, 1) !== "-") ||
            (strlen($personalCode) === 11 && str_contains($personalCode, "-"))) {
            throw new InvalidArgumentException("Invalid format of personal code.");
        }

        $this->personalCode = join("", explode("-", $personalCode));
    }


    private function setLastName(string $lastName): void
    {
        if (count(explode(" ", $lastName)) !== 1) {
            throw new InvalidArgumentException("Last name must not contain spaces.");
        }

        $this->lastName = $this->capitalizeName($lastName);
    }

    private function capitalizeName(string $name): string
    {
        return ucwords($name);
    }

    private function setAge(string $age): void
    {
        if (intval($age) < 0) {
            throw new InvalidArgumentException("Age must be 0 or more.");
        }
        $this->age = $age;
    }

    private function setDescription(string $description = null): void
    {
        $this->description = empty($description) ? "" : $description;
    }
}