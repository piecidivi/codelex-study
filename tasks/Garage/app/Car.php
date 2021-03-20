<?php

namespace App;

class Car implements \JsonSerializable
{
    private int $id;
    private string $make;
    private string $model;
    private int $consumption;
    private int $price;
    private string $picture;
    private string $status;
    const CAR_PICTURE_PATH = "images/";
    const CAR_AVAILABLE = "available";
    const CAR_RENTED = "rented";
    const CAR_BROKEN = "broken";
    const CAR_UNAVAILABLE = "unavailable";

    public function __construct(int $id, string $make, string $model, int $consumption, int $price, string $picture, string $status)
    {
        $this->id = $id;
        $this->make = $make;
        $this->model = $model;
        $this->consumption = $consumption;
        $this->price = $price;
        $this->picture = $picture;
        $this->status = $status;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function make(): string
    {
        return $this->make;
    }

    public function model(): string
    {
        return $this->model;
    }

    public function consumption(): int
    {
        return $this->consumption;
    }

    public function price(): int
    {
        return $this->price;
    }

    public function picture(): string
    {
        return $this->picture;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    // JSON Serialize
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}