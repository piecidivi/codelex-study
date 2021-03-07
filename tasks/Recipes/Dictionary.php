<?php


class Dictionary
{
    private array $ingredientTypes = [];    // Associative array: "ingredient name" => "class name"
    private array $unitTypes = [];
    const NUMERABLE = "Numerable";
    const POURABLE = "Pourable";

    public function getUnitTypes(): array {
        return $this->unitTypes;
    }

    public function getIngredientTypes(): array {
        return $this->ingredientTypes;
    }

    // Check duplicates inside and silently return empty if found one
    public function registerIngredientType(string $name, int $type): void {
        if ($this->checkIngredientTypeRegistered($name)) {
            return;
        }
        if ($type === 1) {
            $this->ingredientTypes[$name] = self::NUMERABLE;
        }
        else if ($type === 2) {
            $this->ingredientTypes[$name] = self::POURABLE;
        }
    }

    // To avoid duplicates
    public function checkIngredientTypeRegistered(string $name): bool {
        return array_key_exists($name, $this->ingredientTypes);
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