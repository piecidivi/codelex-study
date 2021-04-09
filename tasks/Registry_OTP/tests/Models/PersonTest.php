<?php

namespace Tests\Models;

use App\Models\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    public function testPersonalCode(): void
    {
        $person = new Person(
            "12345678901",
            "Gvate Mala",
            "Hondu-Rasa",
            "28",
            "Amatnieku iela 25, Rīga",
            "Up and Running!"
        );

        $this->assertEquals("12345678901", $person->personalCode());
    }

    public function testFirstName(): void
    {
        $person = new Person(
            "12345678901",
            "Gvate Mala",
            "Hondu-Rasa",
            "28",
            "Amatnieku iela 25, Rīga",
            "Up and Running!"
        );

        $this->assertEquals("Gvate Mala", $person->firstName());
    }

    public function testLastName(): void
    {
        $person = new Person(
            "12345678901",
            "Gvate Mala",
            "Hondu-Rasa",
            "28",
            "Amatnieku iela 25, Rīga",
            "Up and Running!"
        );

        $this->assertEquals("Hondu-Rasa", $person->lastName());
    }

    public function testAge(): void
    {
        $person = new Person(
            "12345678901",
            "Gvate Mala",
            "Hondu-Rasa",
            "28",
            "Amatnieku iela 25, Rīga",
            "Up and Running!"
        );

        $this->assertEquals("28", $person->age());
    }

    public function testAddress(): void
    {
        $person = new Person(
            "12345678901",
            "Gvate Mala",
            "Hondu-Rasa",
            "28",
            "Amatnieku iela 25, Rīga",
            "Up and Running!"
        );

        $this->assertEquals("Amatnieku iela 25, Rīga", $person->address());
    }

    public function testDescription(): void
    {
        $person = new Person(
            "12345678901",
            "Gvate Mala",
            "Hondu-Rasa",
            "28",
            "Amatnieku iela 25, Rīga",
            "Up and Running!"
        );

        $this->assertEquals("Up and Running!", $person->description());
    }

    public function testNullDescription(): void
    {
        $person = new Person(
            "12345678901",
            "Gvate Mala",
            "Hondu-Rasa",
            "28",
            "Amatnieku iela 25, Rīga",
            null
        );

        $this->assertEquals("", $person->description());
    }

    public function testPersonalCodeException11(): void
    {
        $this->expectExceptionMessage("Invalid format of personal code.");

        new Person(
            "-1345678901",
            "Gvate Mala",
            "Hondu-Rasa",
            "28",
            "Amatnieku iela 25, Rīga",
            "Up and Running!"
        );
    }

    public function testPersonalCodeException12(): void
    {
        $this->expectExceptionMessage("Invalid format of personal code.");

        new Person(
            "-12345678901",
            "Gvate Mala",
            "Hondu-Rasa",
            "28",
            "Amatnieku iela 25, Rīga",
            "Up and Running!"
        );
    }

    public function testLastNameException(): void
    {
        $this->expectExceptionMessage("Last name must not contain spaces.");

        new Person(
            "12345678901",
            "Gvate Mala",
            "Hondu Rasa",
            "28",
            "Amatnieku iela 25, Rīga",
            "Up and Running!"
        );
    }

    public function testAgeException(): void
    {
        $this->expectExceptionMessage("Age must be 0 or more.");

        new Person(
            "12345678901",
            "Gvate Mala",
            "Hondu-Rasa",
            "-1",
            "Amatnieku iela 25, Rīga",
            "Up and Running!"
        );
    }
}