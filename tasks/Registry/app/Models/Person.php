<?php

namespace App\Models;

class Person
{
    private int $id;
    private string $personalCode;
    private string $firstName;
    private string $lastName;
    private string $description;

    public function __construct(string $personalCode, string $firstName, string $lastName, string $description)
    {
        $this->personalCode = $personalCode;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->description = $description;
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

    public function description(): string
    {
        return $this->description;
    }
}