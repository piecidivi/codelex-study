<?php

require_once "Ingredient.php";
require_once "Pourable.php";
require_once "Numerable.php";
require_once "Dictionary.php";
require_once "IngredientsCollection.php";
require_once "RecipesCollection.php";
require_once "View.php";
require_once "appControl.php";

// Application
// [1] Add IngredientsCollection - Name; Ingredients (small spoon, big spoon, glass, grams, pieces; and name of ingredient)
// -> then foreach generates IngredientsCollection
// Spoon and glass is "Pourable" properties, which are saved for IngredientsCollection, and then for basket are calculated inside class.
// [2] Add basket to see what You get -> foreach stores and prints out basket; then calculates possible IngredientsCollection or Recipes.
// [3] Quit

// Initialize dictionary
$dictionary = new Dictionary();

// Register Units
registerUnits($dictionary);

// Unit Type list check === all good
foreach ($dictionary->getUnitTypes() as $unitType => $unitAmount) {
    echo "$unitType => $unitAmount\n";
}


// Register Ingredient Types: 1 - Numerable, 2 - Pourable
registerIngredients($dictionary);

// Ingredient Type list check === all good
foreach ($dictionary->getIngredientTypes() as $ingredientName => $ingredientType) {
    echo "$ingredientName is type of $ingredientType\n";
}

// Create 1 Recipe
$carrotSaladRecipe = new IngredientsCollection("recipe", "Carrot salad");
$ingredientClass = $dictionary->getIngredientTypes()["chicken"];
$carrotSaladRecipe->addIngredient(new $ingredientClass("chicken", "gram", 300, 2000));
$ingredientClass = $dictionary->getIngredientTypes()["corn"];
$carrotSaladRecipe->addIngredient(new $ingredientClass("corn", "gram", 350, 2));
$ingredientClass = $dictionary->getIngredientTypes()["carrot"];
$carrotSaladRecipe->addIngredient(new $ingredientClass("carrot", "gram", 200, 60));
$ingredientClass = $dictionary->getIngredientTypes()["garlic"];
$carrotSaladRecipe->addIngredient(new $ingredientClass("garlic", "piece", 2, 5));
$ingredientClass = $dictionary->getIngredientTypes()["orange juice"];
$carrotSaladRecipe->addIngredient(new $ingredientClass("orange juice", "teaspoon", 2, 1.014));
$ingredientClass = $dictionary->getIngredientTypes()["lemon juice"];
$carrotSaladRecipe->addIngredient(new $ingredientClass("lemon juice", "teaspoon", 1, 1.03));
$ingredientClass = $dictionary->getIngredientTypes()["honey"];
$carrotSaladRecipe->addIngredient(new $ingredientClass("honey", "teaspoon", 1, 1.42));
$ingredientClass = $dictionary->getIngredientTypes()["cream"];
$carrotSaladRecipe->addIngredient(new $ingredientClass("cream", "tablespoon", 3, 1.035));
$ingredientClass = $dictionary->getIngredientTypes()["salt"];
$carrotSaladRecipe->addIngredient(new $ingredientClass("salt", "pinch", 2, 2.16));
// var_dump($carrotSaladRecipe);

echo "\nPrint out of \"{$carrotSaladRecipe->getName()}\" recipe:\n----------------------------------------\n";
// Print out recipe
foreach ($carrotSaladRecipe->getNumerables() as $numerable) {
    /** @var Numerable $numerable */
    echo "{$numerable->getAmount()} {$numerable->getUnitType()} {$numerable->getName()}\n";
}
foreach ($carrotSaladRecipe->getPourables() as $pourable) {
    /** @var Pourable $pourable */
    echo "{$pourable->getAmount()} {$pourable->getUnitType()} {$pourable->getName()}\n";
}

