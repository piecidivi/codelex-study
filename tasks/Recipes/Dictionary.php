<?php


class Dictionary
{
    private array $ingredientTypes = [];    // Associative array: "ingredient name" => "class name"
    private array $unitTypes = [];          // Associative array: "unit type" => amount
    const NUMERABLE = "Numerable";
    const POURABLE = "Pourable";

    public function getUnitTypes(): array
    {
        return $this->unitTypes;
    }

    public function getIngredientTypes(): array
    {
        return $this->ingredientTypes;
    }

    // Check duplicates inside and silently return empty if found
    public function registerIngredientType(string $name, int $type): void
    {
        if ($this->checkIngredientTypeRegistered($name)) {
            return;
        }
        if ($type === 1) {
            $this->ingredientTypes[$name] = self::NUMERABLE;
        } else if ($type === 2) {
            $this->ingredientTypes[$name] = self::POURABLE;
        }
    }

    // To avoid duplicates
    private function checkIngredientTypeRegistered(string $name): bool
    {
        return array_key_exists($name, $this->ingredientTypes);
    }

    // Check duplicates inside, and silently return empty if found
    public function registerUnitType(string $name, int $amount): void
    {
        if ($this->checkUnitTypeRegistered($name)) {
            return;
        }
        $this->unitTypes[$name] = $amount;
    }

    // To avoid duplicates
    private function checkUnitTypeRegistered(string $name): bool
    {
        return array_key_exists($name, $this->unitTypes);
    }
}