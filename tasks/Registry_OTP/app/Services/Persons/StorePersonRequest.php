<?php

namespace App\Services\Persons;

class StorePersonRequest
{
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
        string $description
    )

    {
        $this->personalCode = $personalCode;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->address = $address;
        $this->description = $description;
    }

    public function getPersonalCode(): string
    {
        return $this->personalCode;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getAge(): string
    {
        return $this->age;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}