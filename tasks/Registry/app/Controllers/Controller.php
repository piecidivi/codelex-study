<?php

namespace App\Controllers;

use App\Repositories\PersonRepositoryInterface;

class Controller
{
    private PersonRepositoryInterface $persons;

    public function __construct(PersonRepositoryInterface $persons)
    {

        $this->persons = $persons;
    }

    public function index():void
    {
        // PHPStorm does not resolve it, but this path runs in respect to location of index.php
        require_once "../app/Views/home.php";
    }

    public function addPerson(): void
    {
        echo "AAA";
        var_dump($_POST);
    }
}