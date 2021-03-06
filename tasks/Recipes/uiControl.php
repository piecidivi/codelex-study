<?php


function menuInput(string $menu, int $lowerBoundary, int $upperBoundary): int {
    echo $menu;
    $choice = intval(trim(readline("Your choice: ")));
    while ($choice < $lowerBoundary || $choice > $upperBoundary) {
        $choice = intval(trim(readline("Wrong selection. Please repeat: ")));
    }
    return $choice;
}

/*
function menuAmount(): int {
    $amount = intval(trim(readline("Please set amount of item (pieces, grams, or milliliters")))
}
*/