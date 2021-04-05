<?php

namespace App\Repositories\Persons;

use App\Models\Person;
use InvalidArgumentException;
use Medoo\Medoo;
use PDO;
use PDOException;

class MySQLPersonRepository implements PersonRepository
{
    private Medoo $database;

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

    public function getById(string $searchValue): array
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $record = $this->database->select("Person", "*", [
            "personal_code" => "$searchValue",
            "LIMIT" => 1
        ]);

        return $this->getPersons($record);
    }

    public function update(Person $person): bool
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $record = $this->database->update("Person", [
            "age" => $person->age(),
            "address" => $person->address(),
            "description" => $person->description()
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

    private function init(): string
    {
        try {
            $this->database = new Medoo([
                "database_type" => $_ENV["DB_TYPE"],
                "database_name" => $_ENV["DB_NAME"],
                "server" => $_ENV["DB_HOST"],
                "username" => $_ENV["DB_USER"],
                "password" => $_ENV["DB_PASSWORD"],
                "charset" => $_ENV["DB_CHARSET"],
                "option" => [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::MYSQL_ATTR_FOUND_ROWS => true,    // Without this on change, but identical row will return 0
                    PDO::ATTR_PERSISTENT => true    // Keep persistent connection
                ]
            ]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return "All good";
    }

    private function getPersons(array $records): array
    {
        $persons = [];

        foreach ($records as $record) {
            $persons[] = new Person($record["personal_code"], $record["first_name"],
                $record["last_name"], $record["age"], $record["address"], $record["description"]);
        }

        return $persons;
    }
}