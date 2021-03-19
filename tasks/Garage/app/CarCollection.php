<?php

namespace App;

class CarCollection
{
    private array $cars = [];

    public function __construct()
    {
        $json = file_get_contents(__DIR__ . "/Storage/rental-cars.json");
        $cars = json_decode($json);

        foreach ($cars as $car) {
            $this->cars[] = new Car($car->id, $car->make, $car->model,
                $car->consumption, $car->price, $car->status);
        }
    }

    public function cars(): array
    {
        return $this->cars;
    }

    public function changeStatus(string $status): void
    {
        list($id, $status) = explode("/", $status);
        // var_dump($id);
        foreach ($this->cars as $car) {
            /** @var Car $car */ {
                if ($car->id() === intval($id)) {
                    $car->setStatus($status);
                }
            }
        }
        $this->save();
    }

    private function save(): void
    {
        $json = json_encode($this->cars);
        file_put_contents(__DIR__ . "/Storage/rental-cars.json", $json);
    }
}