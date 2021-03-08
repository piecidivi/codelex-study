<?php


abstract class Warehouse
{
    protected string $name;
    protected array $flowers = [];

    public function __construct(string $name) {
        $this->name = $name;
    }

    // First array holds Flower objects. Second array holds amount of certain flowers to add to collection.
    public function addFlowers(array $flowerObjects, array $flowerCount): void
    {
        for ($i = 0; $i < count($flowerObjects); ++$i) {
            $count = $flowerCount[$i];
            while ($count > 0) {
                $this->add($flowerObjects[$i]);
                $count--;
            }
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