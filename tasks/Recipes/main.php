<?php

require_once "Ingredient.php";
require_once "Pourable.php";
require_once "Numerable.php";
require_once "Weighable.php";

// Application
// [1] Add Recipe - Name; Ingredients (small spoon, big spoon, glass, grams, pieces; and name of ingredient) -> then foreach generates Recipe
// Spoon and glass is "Pourable" properties, which are saved for Recipe, and then for basket are calculated inside class.
// [2] Add basket to see what You get -> foreach stores and prints out basket; then calculates possible Recipe or Recipes.
// [3] Quit
