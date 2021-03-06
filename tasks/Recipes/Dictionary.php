<?php


class Dictionary
{
    private array $ingredients = [];
    private array $units = [];

    public function getUnits(): array {
        return $this->units;
    }

    public function getIngredients(): array {
        return $this->getIngredients();
    }

    public function registerIngredient(string $name, int $type): void {
        $this->ingredients[] = new IngredientType($name, $type);
    }

    // To avoid duplicates
    public function checkIngredientRegistered(string $name): bool {
        return count(array_filter($this->ingredients, function(IngredientType $ingredient) use ($name): bool {
            return $ingredient->getName() === $name;
        })) > 0;
    }

    // Check duplicates inside, and return silently if found one
    public function registerUnit(string $name, int $type, int $amount): void {
        if ($this->checkUnitRegistered($name)) {
            return;
        }
        $this->units[] = new UnitType($name, $type, $amount);
    }

    // To avoid duplicates
    private function checkUnitRegistered(string $name): bool {
        return count(array_filter($this->units, function(UnitType $unitType) use ($name): bool {
            return $unitType->getName() === $name;
        })) > 0;
    }
}