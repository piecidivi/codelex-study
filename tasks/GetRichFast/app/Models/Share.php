<?php

namespace App\Models;

use InvalidArgumentException;
use JsonSerializable;

class Share implements JsonSerializable
{
    private int $id;
    private string $symbol;
    private int $amount;
    private int $priceOne;
    private int $priceTotal;
    private int $quote;
    private int $project;
    private string $purchaseDate;
    private string $status;
    private string $profitState;

    const INT_FLOAT_CONVERSION = 100;

    const PROFIT_NEGATIVE = "red";
    const PROFIT_EVEN = "gray";
    const PROFIT_POSITIVE = "green";

    const SHARE_STATUS_OPEN = "open";
    const SHARE_STATUS_CLOSED = "closed";

    public function __construct(
        string $symbol,
        int $amount = 0,
        int $priceOne = 0,
        int $id = -1,
        int $quote = 0,
        int $project = 0,
        string $purchaseDate = "0",
        string $status = self::SHARE_STATUS_OPEN,
        string $profitState = self::PROFIT_EVEN
    )
    {
        $this->symbol = $symbol;
        $this->id = $id;
        $this->amount = $amount;
        $this->priceOne = $priceOne;
        $this->quote = $quote;
        $this->project = $project;
        $this->purchaseDate = $purchaseDate;
        $this->status = $status;
        $this->profitState = $profitState;
        $this->setPriceTotal();
    }

    public function id(): int
    {
        return $this->id;
    }

    public function symbol(): string
    {
        return $this->symbol;
    }

    public function profitState(): string
    {
        return $this->profitState;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function priceOne(): int
    {
        return $this->priceOne;
    }

    public function priceTotal(): int
    {
        return $this->priceTotal;
    }

    public function quote(): int
    {
        return $this->quote;
    }

    public function project(): int
    {
        return $this->project;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function purchaseDate(): string
    {
        return $this->purchaseDate;
    }

    public function buy(int $amount): void
    {
        $this->amount += $amount;
        $this->status = self::SHARE_STATUS_OPEN;
    }

    public function sell(): void
    {
        $this->amount = 0;
        $this->status = self::SHARE_STATUS_CLOSED;
    }

    public function setQuote(float $quote): void
    {
        $this->quote = $quote * self::INT_FLOAT_CONVERSION;
        $this->setProject();
        $this->setProfitState();
    }

    private function setProject(): void
    {
        $this->project = abs($this->quote - $this->priceOne) * $this->amount;
    }

    private function setProfitState(): void
    {
        if ($this->quote > $this->priceOne) {
            $this->profitState = self::PROFIT_POSITIVE;
        }

        if ($this->quote < $this->priceOne) {
            $this->profitState = self::PROFIT_NEGATIVE;
        }
    }

    private function setPriceTotal(): void
    {
        $this->priceTotal = $this->priceOne * $this->amount;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}