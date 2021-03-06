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
        $keys = $dictionary->getIngredientsKeys();
        $str = " Add items to recipe";
        $str .= "\n--------------------\n";
        $str .= " [0] Exit; [1] New item\n";
        for ($i = 2; $i < count($keys) + 2; ++$i) {
            $str .= " [" . $i . "] {$keys[$i]}\n";
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