<?php


class Flower
{
    private string $name;
    private int $price;
    const CONVERTER = 100;  // Accept price as float, and convert to integer cutting off anything after 2 decimals

    public function __construct(string $name, float $price = 0)
    {
        $this->name = $name;
        $this->$price = $price * self::CONVERTER;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}