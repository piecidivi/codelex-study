<?php

// Automatic procedures

// Register Unit Types: 1 - pieces, 2 - weight, 3 - volume
function registerUnits(Dictionary $dictionary): void {
    $dictionary->registerUnitType("piece", 1);         // pcs          (pieces, type 1)
    $dictionary->registerUnitType("gram", 1);          // grams        (weight, type 2)
    $dictionary->registerUnitType("ml", 1);            // milliliters  (volume, type 3)
    $dictionary->registerUnitType("pinch", 2);         // pinch        (volume, type 3)
    $dictionary->registerUnitType("teaspoon", 5);      // teaspoon     (volume, type 3)
    $dictionary->registerUnitType("tablespoon", 15);   // tablespoon   (volume, type 3)
    $dictionary->registerUnitType("glass", 250);       // glass        (volume, type 3)
}

// Register Ingredient Types: 1 - Numerable, 2 - Pourable
function registerIngredients(Dictionary $dictionary): void {
    $dictionary->registerIngredientType("chicken", 1);
    $dictionary->registerIngredientType("corn", 1);
    $dictionary->registerIngredientType("carrot", 1);
    $dictionary->registerIngredientType("garlic", 1);
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