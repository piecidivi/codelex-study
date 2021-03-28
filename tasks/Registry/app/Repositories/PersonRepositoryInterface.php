<?php

namespace App\Repositories;

use App\Models\Person;

interface PersonRepositoryInterface
{
    public function add(Person $person): void;      // Maybe we have here some return type for success - test Medoo

    public function find($value): Person;

    public function remove(Person $person): void;
}