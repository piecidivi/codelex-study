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

    // Method returning string required in task definition.
    public function showUserNameAndBalance(): string
    {
        return "$this->name,  " . $this->checkSign() . " $" . number_format(abs($this->balance / 100), 2, ".", ",");
    }

    private function checkSign(): string {
        return $this->balance < 0 ? "-" : "";
    }

}