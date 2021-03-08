<?php


class Executables
{
    // Pre-defined procedures
    // Register Unit Types
    public static function registerUnits(Dictionary $dictionary): void
    {
        $dictionary->registerUnitType("piece", 1);         // pcs          (pieces, type 1)
        $dictionary->registerUnitType("gram", 1);          // grams        (weight, type 2)
        $dictionary->registerUnitType("ml", 1);            // milliliters  (volume, type 3)
        $dictionary->registerUnitType("pinch", 2);         // pinch        (volume, type 3)
        $dictionary->registerUnitType("teaspoon", 5);      // teaspoon     (volume, type 3)
        $dictionary->registerUnitType("tablespoon", 15);   // tablespoon   (volume, type 3)
        $dictionary->registerUnitType("glass", 250);       // glass        (volume, type 3)
    }

    // Register Ingredient Types: 1 - Numerable, 2 - Pourable
    public static function registerIngredients(Dictionary $dictionary): void
    {
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

    public static function createSaladRecipe(Dictionary $dictionary): IngredientsCollection
    {
        $recipe = new IngredientsCollection("recipe", "Carrot salad");
        $ingredientClass = $dictionary->getIngredientTypes()["chicken"];
        $recipe->addIngredient(new $ingredientClass("chicken", "gram", 300, 2000));
        $ingredientClass = $dictionary->getIngredientTypes()["corn"];
        $recipe->addIngredient(new $ingredientClass("corn", "gram", 350, 2));
        $ingredientClass = $dictionary->getIngredientTypes()["carrot"];
        $recipe->addIngredient(new $ingredientClass("carrot", "gram", 200, 60));
        $ingredientClass = $dictionary->getIngredientTypes()["garlic"];
        $recipe->addIngredient(new $ingredientClass("garlic", "piece", 2, 5));
        $ingredientClass = $dictionary->getIngredientTypes()["orange juice"];
        $recipe->addIngredient(new $ingredientClass("orange juice", "teaspoon", 2, 1.014));
        $ingredientClass = $dictionary->getIngredientTypes()["lemon juice"];
        $recipe->addIngredient(new $ingredientClass("lemon juice", "teaspoon", 1, 1.03));
        $ingredientClass = $dictionary->getIngredientTypes()["honey"];
        $recipe->addIngredient(new $ingredientClass("honey", "teaspoon", 1, 1.42));
        $ingredientClass = $dictionary->getIngredientTypes()["cream"];
        $recipe->addIngredient(new $ingredientClass("cream", "tablespoon", 3, 1.035));
        $ingredientClass = $dictionary->getIngredientTypes()["salt"];
        $recipe->addIngredient(new $ingredientClass("salt", "pinch", 2, 2.16));
        return $recipe;
    }

    public static function createBasket(Dictionary $dictionary): IngredientsCollection
    {
        $basket = new IngredientsCollection("basket", "Sunday");
        $ingredientClass = $dictionary->getIngredientTypes()["chicken"];
        $basket->addIngredient(new $ingredientClass("chicken", "piece", 1));
        $ingredientClass = $dictionary->getIngredientTypes()["corn"];
        $basket->addIngredient(new $ingredientClass("corn", "gram", 400));
        $ingredientClass = $dictionary->getIngredientTypes()["carrot"];
        $basket->addIngredient(new $ingredientClass("carrot", "piece", 4));
        $ingredientClass = $dictionary->getIngredientTypes()["garlic"];
        $basket->addIngredient(new $ingredientClass("garlic", "piece", 3));
        $ingredientClass = $dictionary->getIngredientTypes()["orange juice"];
        $basket->addIngredient(new $ingredientClass("orange juice", "ml", 1000));
        $ingredientClass = $dictionary->getIngredientTypes()["lemon juice"];
        $basket->addIngredient(new $ingredientClass("lemon juice", "ml", 1000));
        $ingredientClass = $dictionary->getIngredientTypes()["honey"];
        $basket->addIngredient(new $ingredientClass("honey", "ml", 500));
        $ingredientClass = $dictionary->getIngredientTypes()["cream"];
        $basket->addIngredient(new $ingredientClass("cream", "gram", 450));
        $ingredientClass = $dictionary->getIngredientTypes()["salt"];
        $basket->addIngredient(new $ingredientClass("salt", "gram", 1000));
        return $basket;
    }
}