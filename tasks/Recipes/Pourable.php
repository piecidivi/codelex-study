<?php



// Units measured in volume milliliters (1 milliliter === 0.001 liter)
class Pourable extends Ingredient
{
    // Convert both to milliliters
    // If amount in basket is bigger than in recipe, then return true
    public static function compareItems(Pourable $recipeItem, Pourable $basketItem, Dictionary $dictionary): bool {

        if ($recipeItem->getUnitType() === "gram") $recipeVariable = $recipeItem->getAmount() / $recipeItem->getVariable();
        else $recipeVariable = $recipeItem->getAmount() * $dictionary->getUnitTypes()[$recipeItem->getUnitType()];

        if ($basketItem->getUnitType() === "gram") $basketVariable = $basketItem->getAmount() / $recipeItem->getVariable();
        else $basketVariable = $basketItem->getAmount();

        return $basketVariable > $recipeVariable;
    }
}