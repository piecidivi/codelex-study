<?php

namespace App\Repositories;

use App\Models\Person;
use Medoo\Medoo;

class MySQLPersonRepository implements PersonRepositoryInterface
{
    private Medoo $database;

    public function __construct()
    {
        $this->database = new Medoo([
            "database_type" => $_ENV["DB_TYPE"],
            "database_name" => $_ENV["DB_NAME"],
            "server" => $_ENV["DB_HOST"],
            "username" => $_ENV["DB_USER"],
            "password" => $_ENV["DB_PASSWORD"]
        ]);
    }

    public function add(Person $person): void
    {
        // TODO: Implement add() method.
    }

    public function find($value): Person
    {
        // TODO: Implement find() method.
    }

    public function remove(Person $person): void
    {
        // TODO: Implement remove() method.
    }
}