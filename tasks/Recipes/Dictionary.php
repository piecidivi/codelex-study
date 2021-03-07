<?php


class Dictionary
{
    private array $ingredientTypes = [];
    private array $unitTypes = [];

    public function getUnits(): array {
        return $this->unitTypes;
    }

    public function getIngredients(): array {
        return $this->getIngredients();
    }

    // Check duplicates inside and silently return empty if found one
    public function registerIngredientType(string $name, int $type): void {
        if ($this->checkIngredientTypeRegistered($name)) {
            return;
        }
        $this->ingredientTypes[] = new IngredientType($name, $type);
    }

    // To avoid duplicates
    public function checkIngredientTypeRegistered(string $name): bool {
        return count(array_filter($this->ingredientTypes, function(IngredientType $ingredientType) use ($name): bool {
            return $ingredientType->getName() === $name;
        })) > 0;
    }

    // Check duplicates inside, and silently return empty if found one
    public function registerUnitType(string $name, int $type, int $amount): void {
        if ($this->checkUnitTypeRegistered($name)) {
            return;
        }
        $this->unitTypes[] = new UnitType($name, $type, $amount);
    }

    // To avoid duplicates
    private function checkUnitTypeRegistered(string $name): bool {
        return count(array_filter($this->unitTypes, function(UnitType $unitType) use ($name): bool {
            return $unitType->getName() === $name;
        })) > 0;
    }
}