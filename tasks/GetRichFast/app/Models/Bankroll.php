<?php

namespace App\Models;

use InvalidArgumentException;
use JsonSerializable;

class Bankroll implements JsonSerializable
{
    private int $id;
    private string $name;
    private int $bankroll;

    public function __construct(int $id, string $name, int $bankroll)
    {
        $this->id = $id;
        $this->name = $name;
        $this->bankroll = $bankroll;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function bankroll(): int
    {
        return $this->bankroll;
    }

    public function buy(int $amount, int $price): void
    {
        if (($amount * $price) > $this->bankroll) {
            throw new InvalidArgumentException("Not enough money for trade.");
        }
        $this->bankroll -= ($amount * $price);
    }

    public function sell(int $amount, int $price): void
    {
        $this->bankroll += ($amount * $price);
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}