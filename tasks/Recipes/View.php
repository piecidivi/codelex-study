<?php

require_once "Dictionary.php";

class View
{
    public static function mainMenu(): string {
        return " Welcome to the Recipes App" .
            "\n---------------------------\n" .
            " [1] Manage Recipes\n [2] Create Basket\n [0] Exit\n";
    }

    public static function manageRecipes(): string {
        return " Recipes Management\n-------------------\n" .
            " [1] Add recipe\n [2] Modify recipe\n [3] Delete recipe\n [0] Go Back\n";
    }

    public static function addRecipe(Dictionary $dictionary): string {
        $ingredients = $dictionary->getIngredients();
        $iterator = 0;
        $str = " Add items to recipe";
        $str .= "\n--------------------\n";
        for ($i = 0; $i < count($ingredients); ++$i) {
            $str .= " [" . ($i + 1) . "] {$ingredients[$i]}\n";
            $iterator = $i;
        }
        $str .= " [" . ($iterator + 1) . "] New Item\n";
        $str .= " [" . ($iterator + 1) . "] Exit\n";
        return $str;
    }

    public static function newItemUnit(Dictionary $dictionary): string {
        $units = $dictionary->getUnits();
        $str = " Choose new item unit";
        $str .= "\n---------------------\n";
        for ($i = 0; $i < count($units); ++$i) {
            $str .= " [" . ($i + 1). "] {$units[$i]}\n";
        }
        return $str;
    }

    public static function chooseClass(): string {
        return " Choose item type - [1] Numerable item [2] Pourable item.";
    }

    public static function createBasket(): string {
        return " Add items to Basket" .
            "\n-------------------\n";
            // Here we will have foreach showing possible items, and 0 at the end to Go Back. (going back looses basket)
            // WE NEED SOME KEY, WHEN WE ARE DONE TO VIEW POSSIBLE RECIPES
    }
}