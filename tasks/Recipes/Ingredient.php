<?php


abstract class Ingredient
{
    protected string $name;
    protected int $amount;

    public function __construct(string $name, string $type, float $amount) {
        $this->name = $name;
        $this->calculateInitialAmount($type, $amount);
    }

    private function calculateInitialAmount(string $type, float $amount): void {
        if ($type === "1") {
            $this->amount = intval($amount);
        } else {
            $this->amount = intval($amount * 1000);
        }
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAmount(): int {
        return $this->amount;
    }
}