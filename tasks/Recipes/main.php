<?php

require_once "Ingredient.php";
require_once "Pourable.php";
require_once "Numerable.php";
require_once "Dictionary.php";
require_once "Recipe.php";
require_once "RecipesCollection.php";
require_once "View.php";
require_once "uiControl.php";
require_once "IngredientType.php";
require_once "UnitType.php";

// Application
// [1] Add Recipe - Name; Ingredients (small spoon, big spoon, glass, grams, pieces; and name of ingredient) -> then foreach generates Recipe
// Spoon and glass is "Pourable" properties, which are saved for Recipe, and then for basket are calculated inside class.
// [2] Add basket to see what You get -> foreach stores and prints out basket; then calculates possible Recipe or Recipes.
// [3] Quit

// Initialize dictionary
$dictionary = new Dictionary();
$dictionary->registerUnitType("pcs", 1, 1);         // pcs          (pieces, type 1)
$dictionary->registerUnitType("g", 2, 1);           // grams        (weight, type 2)
$dictionary->registerUnitType("ml", 3, 1);          // milliliters  (volume, type 3)
$dictionary->registerUnitType("pi", 3, 1);          // pinch        (volume, type 3)
$dictionary->registerUnitType("tsp", 3, 5);         // teaspoon     (volume, type 3)
$dictionary->registerUnitType("tblsp", 3, 15);      // tablespoon   (volume, type 3)
$dictionary->registerUnitType("glass", 3, 250);     // glass        (volume, type 3)

// Unit list check === all good
// foreach ($dictionary->getUnits() as $unit) {
   // /** @var UnitType $unit */
    //echo $unit->getName() . ", " . $unit->getType() . ", " . $unit->getAmount() . PHP_EOL;
// }


// !!! Anything in pieces is saved in as many elements, and counted by type always before output.

