<?php

require_once "Dictionary.php";

// UI functionality
function menuInput(string $menu, int $lowerBoundary, int $upperBoundary): int {
    echo $menu;
    $choice = intval(trim(readline("Your choice: ")));
    while ($choice < $lowerBoundary || $choice > $upperBoundary) {
        $choice = intval(trim(readline("Wrong selection. Please repeat: ")));
    }
    return $choice;
}


function menuAmount(): int {
    do {
        $amount = intval(trim(readline("Please set amount of item in by chosen unit: ")));
    } while ($amount < 1);
    return $amount;
}

// Automatic procedures

// Register Unit Types: 1 - pieces, 2 - weight, 3 - volume
function registerUnits(Dictionary $dictionary): void {
    $dictionary->registerUnitType("pcs", 1, 1);         // pcs          (pieces, type 1)
    $dictionary->registerUnitType("g", 2, 1);           // grams        (weight, type 2)
    $dictionary->registerUnitType("ml", 3, 1);          // milliliters  (volume, type 3)
    $dictionary->registerUnitType("pi", 3, 1);          // pinch        (volume, type 3)
    $dictionary->registerUnitType("tsp", 3, 5);         // teaspoon     (volume, type 3)
    $dictionary->registerUnitType("tblsp", 3, 15);      // tablespoon   (volume, type 3)
    $dictionary->registerUnitType("glass", 3, 250);     // glass        (volume, type 3)
}

// Register Ingredient Types: 1 - Numerable, 2 - Pourable
function registerIngredients(Dictionary $dictionary): void {
    $dictionary->registerIngredientType("chicken", 1);
    $dictionary->registerIngredientType("corn", 1);
    $dictionary->registerIngredientType("carrot", 1);
    $dictionary->registerIngredientType("garlic", 2);
    $dictionary->registerIngredientType("raisins", 2);
    $dictionary->registerIngredientType("orange juice", 2);
    $dictionary->registerIngredientType("lemon juice", 2);
    $dictionary->registerIngredientType("honey", 2);
    $dictionary->registerIngredientType("cream", 2);
    $dictionary->registerIngredientType("salt", 2);
    $dictionary->registerIngredientType("cheese", 1);
    $dictionary->registerIngredientType("apples", 1);
    $dictionary->registerIngredientType("walnuts", 2);
    $dictionary->registerIngredientType("pepper", 2);
    $dictionary->registerIngredientType("fish", 1);
    $dictionary->registerIngredientType("rice", 2);
    $dictionary->registerIngredientType("onion", 1);
    $dictionary->registerIngredientType("spring onion", 1);
    $dictionary->registerIngredientType("eggs", 1);
    $dictionary->registerIngredientType("mayonnaise", 2);
    $dictionary->registerIngredientType("peas", 1);
    $dictionary->registerIngredientType("dills", 1);
    $dictionary->registerIngredientType("tomato", 1);
    $dictionary->registerIngredientType("lettuce", 1);
    $dictionary->registerIngredientType("oil", 2);
    $dictionary->registerIngredientType("mustard", 2);
    $dictionary->registerIngredientType("paprika", 1);
    $dictionary->registerIngredientType("olives", 1);
}