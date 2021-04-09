<?php

namespace App\Repositories\Persons;

use App\Models\Person;
use App\Repositories\MySQLRepository;
use InvalidArgumentException;

class MySQLPersonRepository extends MySQLRepository implements PersonRepository
{
    public function add(Person $person): void
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $this->database->insert("Person", [
            "personal_code" => $person->personalCode(),
            "first_name" => $person->firstName(),
            "last_name" => $person->lastName(),
            "age" => $person->age(),
            "address" => $person->address(),
            "description" => $person->description() === "" ? null : $person->description()
        ]);

        if ($this->database->id() === null) {
            throw new InvalidArgumentException("Personal code must be unique!");
        }
    }

    public function get(string $searchValue): array
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $records = $this->database->select("Person", "*", [
            "OR" => [
                "personal_code[~]" => "$searchValue",
                "first_name[~]" => "$searchValue",
                "last_name[~]" => "$searchValue",
                "age[~]" => "$searchValue",
                "address[~]" => "$searchValue"
            ]
        ]);
        return $this->getPersons($records);
    }

    public function getById(string $searchValue): Person
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $record = $this->database->select("Person", "*", [
            "personal_code" => "$searchValue",
            "LIMIT" => 1
        ]);

        return $this->createOnePerson($record[0]);
    }

    public function update(Person $person): bool
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $record = $this->database->update("Person", [
            "age" => $person->age(),
            "address" => $person->address(),
            "description" => $person->description() === "" ? null : $person->description()
        ], [
            "personal_code" => $person->personalCode()
        ]);

        return $record->rowCount();
    }

    public function delete(Person $person): bool
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $record = $this->database->delete("Person", [
            "personal_code" => $person->personalCode()
        ]);

        return $record->rowCount() > 0;
    }

    private function getPersons(array $records): array
    {
        $persons = [];

        foreach ($records as $record) {
            $persons[] = $this->createOnePerson($record);
        }

        return $persons;
    }

    private function createOnePerson(array $record): Person
    {
        return new Person($record["personal_code"], $record["first_name"],
            $record["last_name"], $record["age"], $record["address"], $record["description"], $record["id"]);
    }
}