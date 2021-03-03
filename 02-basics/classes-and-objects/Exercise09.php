<?php

class BankAccount
{
    private string $name;
    private int $balance;

    public function __construct(string $name, float $balance)
    {
        $this->name = $name;
        $this->balance = (int)($balance * 100);
    }

    public function showUserNameAndBalance(): string
    {
        return "$this->name, $ " . number_format($this->balance / 100, 2, ".", ",");
    }
}

$ben = new BankAccount("Benson", -17.5);
echo $ben->showUserNameAndBalance() . PHP_EOL;