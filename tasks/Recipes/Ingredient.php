<?php


abstract class Ingredient
{
    protected string $name;
    protected string $unitType;
    protected int $amount;
    protected float $variable;

    public function __construct(string $name, string $unitType, int $amount, float $variable = null)
    {
        $this->name = $name;
        $this->unitType = $unitType;
        $this->amount = $amount;

        // Will be set for recipe ingredients. Will not be used for basket ingredients.
        if (isset($variable)) {
            $this->variable = $variable;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getUnitType(): string
    {
        return $this->unitType;
    }

    protected function getVariable(): float
    {
        return $this->variable;
    }
}