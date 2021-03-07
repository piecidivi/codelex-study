<?php

// Units measured in pieces
class Numerable extends Ingredient
{
    // Convert both to grams
    // If amount in basket is bigger than in recipe, then return true
    public static function compareItems(Numerable $recipeItem, Numerable $basketItem): bool {

        if ($recipeItem->getUnitType() === "piece") $recipeVariable = $recipeItem->getAmount() * $recipeItem->getVariable();
        else $recipeVariable = $recipeItem->getAmount();

        if ($basketItem->getUnitType() === "piece") $basketVariable = $basketItem->getAmount() * $recipeItem->getVariable();
        else $basketVariable = $basketItem->getAmount();

        return $basketVariable > $recipeVariable;
    }
}