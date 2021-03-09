<?php


abstract class Warehouse
{
    protected string $name;
    protected array $flowers = [];

    public function __construct(string $name) {
        $this->name = $name;
    }

    // First array holds Flower objects. Second array holds amount of certain flowers to add to collection.
    public function addFlowers(array $flowers): void
    {
        foreach ($flowers as $flower) {
            $this->add($flower);
        }
    }

    protected function add(Flower $flower): void
    {
        $this->flowers[] = $flower;
    }

    public function getFlowers(): array {
        return $this->flowers;
    }

}