<?php


abstract class Ingredient
{
    protected string $name;
    protected string $amountType;
    protected int $amount;

    public function __construct(string $name, string $amountType, int $amount) {
        $this->name = $name;
        $this->amountType = $amountType;
        $this->amount = $amount;
    }


    public function getName(): string {
        return $this->name;
    }

    public function getAmount(): int {
        return $this->amount;
    }

    // return property to set
    public function checkIfSet(): string {
        return array_search(null,get_class_vars(get_class($this)));
    }

}