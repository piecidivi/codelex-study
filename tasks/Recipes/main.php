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
$dictionary->registerUnit("gram", 2, 1);
$dictionary->registerUnit("kilogram", 2, 1000);
$dictionary->registerUnit("milliliter", 3, 1);
$dictionary->registerUnit("liter", 3, 1000);
$dictionary->registerUnit("piece", 1, 1);
$dictionary->registerUnit("teaspoon", 3, 5);
$dictionary->registerUnit("tablespoon", 3, 15);
$dictionary->registerUnit("glass", 3, 250);

foreach ($dictionary->getUnits() as $unit) {
    /** @var UnitType $unit */
    echo $unit->getName() . ", " . $unit->getType() . ", " . $unit->getAmount() . PHP_EOL;
}


/*
do {
    $choice = menuInput(View::mainMenu(), 0, 2);

    if ($choice === 1) {

        $manageRecipes = menuInput(View::manageRecipes(), 0, 3);
        while ($manageRecipes !== 0) {
            switch ($manageRecipes) {
                case 1:
                    // Add recipe
                    do {
                        $dictionary = new Dictionary();
                        $addIngredient = menuInput(View::addRecipe($dictionary),
                            0, count($dictionary->getIngredientsKeys()) + 2);

                        // Add new item
                        if ($addIngredient === 1) {
                            // Ask for name
                            $newIngredientName = readline("Please enter new ingredient name: ");
                            // Check to avoid duplicate
                            if (in_array(strtolower(trim($newIngredientName)), $dictionary->getIngredientsKeys())) {
                                echo "\nThis ingredient has already been registered in system.";
                                continue;
                            } else {
                                $newIngredientClass = menuInput(View::chooseClass(), 1, 2);
                                $ingredientAmount = menuAmount();
                            }

                            // Choose class

                        }

                        // Add existing
                        if ($addIngredient > 1) {

                        }
                    } while ($addIngredient !== 0);
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

    if ($choice === 2) {
        $createBasket = menuInput(View::createBasket(), 0, 1);  // Adjust numbers, when menu completed
    }


} while ($choice !== 0);
*/