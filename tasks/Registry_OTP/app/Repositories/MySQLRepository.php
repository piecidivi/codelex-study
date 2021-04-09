<?php

namespace App\Repositories;

use Medoo\Medoo;
use PDO;
use PDOException;

abstract class MySQLRepository
{
    protected Medoo $database;

    protected function init(): string
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
}