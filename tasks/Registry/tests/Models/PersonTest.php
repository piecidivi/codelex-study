<?php

namespace Tests\Models;

use App\Models\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    public function testPersonalCode(): void
    {
        $person = new Person("12345678901", "Gvate Mala", "Hondu-Rasa", "Up and Running!");
        $this->assertEquals("12345678901", $person->personalCode());
    }

    public function testFirstName(): void
    {
        $person = new Person("12345678901", "Gvate Mala", "Hondu-Rasa", "Up and Running!");
        $this->assertEquals("Gvate Mala", $person->firstName());
    }

    public function testLastName(): void
    {
        $person = new Person("12345678901", "Gvate Mala", "Hondu-Rasa", "Up and Running!");
        $this->assertEquals("Hondu-Rasa", $person->lastName());
    }

    public function testDescription(): void
    {
        $person = new Person("12345678901", "Gvate Mala", "Hondu-Rasa", "Up and Running!");
        $this->assertEquals("Up and Running!", $person->description());
    }
}