<?php


class Flower
{
    private string $name;
    private int $amount;
    private int $price;

    // Price will remain 0 for wholesalers, because that is not a point of task for now.
    public function __construct(string $name, int $amount, int $price = 0)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function addAmount(int $amount): void
    {
        $this->amount += $amount;
    }

    public function deductAmount(int $amount): void
    {
        $this->amount -= $amount;
    }
}