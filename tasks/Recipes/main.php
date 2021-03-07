<?php

require_once "Ingredient.php";
require_once "Pourable.php";
require_once "Numerable.php";
require_once "Dictionary.php";
require_once "Recipe.php";
require_once "RecipesCollection.php";
require_once "View.php";
require_once "appControl.php";
require_once "UnitType.php";

// Application
// [1] Add Recipe - Name; Ingredients (small spoon, big spoon, glass, grams, pieces; and name of ingredient) -> then foreach generates Recipe
// Spoon and glass is "Pourable" properties, which are saved for Recipe, and then for basket are calculated inside class.
// [2] Add basket to see what You get -> foreach stores and prints out basket; then calculates possible Recipe or Recipes.
// [3] Quit

// Initialize dictionary
$dictionary = new Dictionary();

// Register Units
registerUnits($dictionary);

// Unit Type list check === all good
// foreach ($dictionary->getUnitTypes() as $unitType) {
   // /** @var UnitType $unitType */
   //  echo "{$unitType->getName()}, {$unitType->getType()}, {$unitType->getAmount()}\n";
// }


// !!! Anything in pieces is saved in as many elements, and counted by type always before output.

// Register Ingredient Types: 1 - Numerable, 2 - Pourable
registerIngredients($dictionary);

// Ingredient Type list check === all good
// foreach ($dictionary->getIngredientTypes() as $ingredientType) {
//    /** @var IngredientType $ingredientType */
//    echo "{$ingredientType->getName()}, {$ingredientType->getType()}\n";
//}

// Create 1 Recipe
$carrotSaladRecipe = new Recipe("Carrot salad");
$ingredientClass = $dictionary->
$carrotSaladRecipe->addIngredient();