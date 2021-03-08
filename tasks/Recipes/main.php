<?php

require_once "Ingredient.php";
require_once "Pourable.php";
require_once "Numerable.php";
require_once "Dictionary.php";
require_once "IngredientsCollection.php";
require_once "Executables.php";
require_once "View.php";

// Initialize dictionary
$dictionary = new Dictionary();

// Register Units (appControl file)
Executables::registerUnits($dictionary);

// Unit Type List
echo View::listUnitTypes($dictionary);

// Register Ingredient Types: 1 - Numerable, 2 - Pourable
Executables::registerIngredients($dictionary);

// Ingredient Type list
echo View::listIngredientTypes($dictionary);

// Create Carrot Salad Recipe
$carrotSaladRecipe = Executables::createSaladRecipe($dictionary);

// Create Sunday Basket
$sundayBasket = Executables::createBasket($dictionary);

// Print out salad
echo View::printIngredientCollection($carrotSaladRecipe);

// Print out basket
echo View::printIngredientCollection($sundayBasket);

// Test basket
if (IngredientsCollection::checkBasket($carrotSaladRecipe, $sundayBasket, $dictionary)) {
    echo "\nBasket contains enough ingredients to make \"{$carrotSaladRecipe->getName()}\"!\n";
} else {
    echo "There are not enough ingredients in basket to make \"{$carrotSaladRecipe->getName()}\"!\n";
}