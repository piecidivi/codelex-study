<?php

require_once "Typification.php";

class IngredientType extends Typification
{
    const NUMERABLE = "Numerable";
    const POURABLE = "Pourable";

    public function __construct(string $name, int $type) {
        $this->name = $name;
        $this->setClass($type);
    }

    private function setClass(int $type): void {
        if ($type === 1) $this->type = self::NUMERABLE;
        if ($type === 2) $this->type = self::POURABLE;
    }
}