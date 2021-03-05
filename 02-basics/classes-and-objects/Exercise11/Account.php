<?php


class Account
{
    private string $name;
    private int $balance = 0;   // Incoming money is converted to integer, and converted back to float on output.

    public function __construct(string $name, float $initialBalance)
    {
        $this->name = $name;
        $this->deposit($initialBalance);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBalance(): float
    {
        return $this->balance / 100;
    }

    public function deposit(float $deposit): void
    {
        $this->balance += intval($deposit * 100);
    }

    public function withdraw(float $withdraw): void
    {
        $this->balance -= intval($withdraw * 100);
    }

    public static function transfer(Account $from, Account $to, float $howMuch): void
    {
        $from->withdraw($howMuch);
        $to->deposit($howMuch);
    }
}