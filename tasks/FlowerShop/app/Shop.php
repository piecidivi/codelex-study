<?php

namespace App;

class Shop extends Warehouse
{
    private int $money;

    public function __construct(string $name, int $initialMoney)
    {
        parent::__construct($name);
        $this->money = $initialMoney;
    }

    public function getBalance(): int
    {
        return $this->money;
    }

    public function addMoney(int $money): void
    {
        $this->money += $money;
    }

    public function deductMoney(int $money): void
    {
        $this->money -= $money;
    }
}