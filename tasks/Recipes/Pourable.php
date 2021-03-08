<?php


class Pourable extends Ingredient
{
    // Convert both to milliliters
    // If amount in basket is even or more than in recipe, return true
    public static function compareItems(Pourable $recipeItem, Pourable $basketItem, Dictionary $dictionary): bool
    {
        if ($recipeItem->getUnitType() === "gram") $recipeVariable = $recipeItem->getAmount() / $recipeItem->getVariable();
        else $recipeVariable = $recipeItem->getAmount() * $dictionary->getUnitTypes()[$recipeItem->getUnitType()];

        if ($basketItem->getUnitType() === "gram") $basketVariable = $basketItem->getAmount() / $recipeItem->getVariable();
        else $basketVariable = $basketItem->getAmount();

        return $basketVariable >= $recipeVariable;
    }
}