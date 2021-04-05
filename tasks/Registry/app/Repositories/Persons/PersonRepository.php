<?php

namespace App\Repositories\Persons;

use App\Models\Person;

interface PersonRepository
{
    public function add(Person $person): void;

    public function get(string $searchValue): array;

    public function getById(string $searchValue): array;

    public function update(Person $person): bool;

    public function delete(Person $person): bool;
}