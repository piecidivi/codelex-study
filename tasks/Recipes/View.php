<?php


class View
{
    public static function listUnitTypes(Dictionary $dictionary): string
    {
        $str = "\nList of Unit Types\n--------------------\n";
        foreach ($dictionary->getUnitTypes() as $unitType => $unitAmount) {
            $str .= "$unitType => $unitAmount\n";
        }
        return $str;
    }

    public static function listIngredientTypes(Dictionary $dictionary): string
    {
        $str = "\nList of Ingredient Types\n------------------------\n";
        foreach ($dictionary->getIngredientTypes() as $ingredientName => $ingredientType) {
            $str .= "$ingredientName is type of $ingredientType\n";
        }
        return $str;
    }

    public static function printIngredientCollection(IngredientsCollection $ingredientsCollection): string
    {
        $str = "";
        if ($ingredientsCollection->getType() === "recipe") {
            $str .= "\nIngredients of \"{$ingredientsCollection->getName()}\" recipe:\n----------------------------------------\n";
        };
        if ($ingredientsCollection->getType() === "basket") {
            $str .= "\nContents of \"{$ingredientsCollection->getName()}\" basket:\n----------------------------------------\n";
        }
        foreach ($ingredientsCollection->getNumerables() as $numerable) {
            /** @var Numerable $numerable */
            $str .= "{$numerable->getAmount()} {$numerable->getUnitType()} {$numerable->getName()}\n";
        }
        foreach ($ingredientsCollection->getPourables() as $pourable) {
            /** @var Pourable $pourable */
            $str .= "{$pourable->getAmount()} {$pourable->getUnitType()} {$pourable->getName()} \n";
        }
        return $str;
    }
}