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


// !!! "Numerable" amount in class is always 1 for 1 instance, and count instances !!!

// Let us try this.

// Initialize dictionary
$dictionary = new Dictionary();
$dictionary->registerUnit("grams", 2, 1);
$dictionary->registerUnit("milliliters", 3, 1);
$dictionary->registerUnit("piece", 1, 1);
$dictionary->registerUnit("teaspoon", 3, 5);
$dictionary->registerUnit("tablespoon", 3, 15);
$dictionary->registerUnit("glass", 3, 250);

// Unit list check === all good
// foreach ($dictionary->getUnits() as $unit) {
   // /** @var UnitType $unit */
    //echo $unit->getName() . ", " . $unit->getType() . ", " . $unit->getAmount() . PHP_EOL;
// }



do {
    $choice = menuInput(View::mainMenu(), 0, 2);

    // Play with Recipes
    if ($choice === 1) {
        $manageRecipes = menuInput(View::manageRecipes(), 0, 3);
        while ($manageRecipes !== 0) {
            switch ($manageRecipes) {
                case 1:
                    // Add recipe
                    do {
                        $addIngredient = (menuInput(View::addRecipe($dictionary),
                            0, count($dictionary->getIngredients()) + 2) - 1);   // + 1 inside for iterator; -1 to match selection

                        // Add new item - number will be even with count after -1, because all array elements will be smaller than count
                        if ($addIngredient === count($dictionary->getIngredients())) {
                            // Ask for name
                            $newIngredientName = readline("Please enter new ingredient name: ");
                            // Check to avoid duplicate
                            if ($dictionary->checkIngredientRegistered(strtolower(trim($newIngredientName)))) {
                                echo "\nThis ingredient has already been registered in system.";
                                continue;
                            } else {
                                $newIngredientClass = menuInput(View::chooseClass(), 1, 2);
                                $newItemUnit = (menuInput(View::newItemUnit($dictionary), 1, count($dictionary->getUnits()) + 1) - 1);
                                $newItemAmount = menuAmount();
                                // Now we have to save new ingredient!!!
                            }

                        }

                        // Add existing
                        if ($addIngredient < count($dictionary->getIngredients())) {
                            // Do something
                            $a = 1;
                        }
                    } while ($addIngredient !== $dictionary->getIngredients() + 2);
                    break;
                case 2:
                    // Modify recipe
                    break;
                case 3:
                    // Delete recipe
                    break;
            }
        }
    }

    // Play with Basket
    if ($choice === 2) {
        $createBasket = menuInput(View::createBasket(), 0, 1);  // Adjust numbers, when menu completed
    }


} while ($choice !== 0);
