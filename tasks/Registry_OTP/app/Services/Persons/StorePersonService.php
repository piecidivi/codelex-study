<?php

namespace App\Services\Persons;

use App\Models\Person;
use App\Repositories\Persons\PersonRepository;

class StorePersonService
{
    private PersonRepository $personsRepository;

    public function __construct(PersonRepository $personsRepository)
    {
        $this->personsRepository = $personsRepository;
    }

    public function add(StorePersonRequest $request): void
    {
        $this->personsRepository->add($this->initPerson($request));
    }

    public function get(string $searchValue): array
    {
        return $this->personsRepository->get($searchValue);
    }

    public function getById(string $searchValue): Person
    {
        return $this->personsRepository->getById($searchValue);
    }

    public function update(StorePersonRequest $request): bool
    {
        return $this->personsRepository->update($this->initPerson($request));
    }

    public function delete(StorePersonRequest $request): bool
    {
        return $this->personsRepository->delete($this->initPerson($request));
    }

    private function initPerson(StorePersonRequest $request): Person
    {
        return new Person(
            $request->getPersonalCode(),
            $request->getFirstName(),
            $request->getLastName(),
            $request->getAge(),
            $request->getAddress(),
            $request->getDescription()
        );
    }
}