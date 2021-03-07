<?php


abstract class Ingredient
{
    protected string $name;
    protected string $unitType;
    protected int $amount;
    protected int $variable;

    public function __construct(string $name, string $unitType, int $amount, ?int $variable) {
        $this->name = $name;
        $this->unitType = $unitType;
        $this->amount = $amount;

        // Will be set for recipes ingredients. Will not be used for basket ingredients.
        if (isset($variable)) {
            $this->variable = $variable;
        }
    }


    public function getName(): string {
        return $this->name;
    }

    public function getAmount(): int {
        return $this->amount;
    }

}