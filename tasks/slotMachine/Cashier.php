<?php

class Cashier
{
    private int $balance;
    private int $betSize;
    private int $betTotal;
    const MINBET = 10;

    public function __construct(int $balance)
    {
        $this->balance = $balance;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function getBetSize(): int
    {
        return $this->betSize;
    }

    public function getTotalBet(): int
    {
        return $this->betTotal;
    }

    public function getBetLimit(): int
    {
        return $this->balance / 10;
    }

    public function setBetSize(int $betSize): void
    {
        $this->betSize = $betSize;
        $this->betTotal = $this->betSize * 10;
    }

    // Checks money for minimum play
    public function noMoney(): bool
    {
        return ($this->balance - self::MINBET) < 0;
    }

    // Checks money for current bet
    public function checkBalance(): bool
    {
        return ($this->balance - $this->betTotal) >= 0;
    }

    public function deduct(): void
    {
        $this->balance -= $this->betTotal;
    }

    // Returns total win for output
    public function add(array $winnings): int
    {
        $win = 0;
        foreach ($winnings as $winning) {
            $win += ($this->betSize * $winning);
        }
        $this->balance += $win;
        return $win;
    }
}