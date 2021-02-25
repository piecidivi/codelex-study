<?php

echo "Welcome to Piglet!\n";
$totalPoints = 0;

do {
    $turn = mt_rand(1, 6);
    if ($turn === 1) {
        $totalPoints = 0;
        echo "You rolled a $turn!\n";
        break;
    }
    $totalPoints += $turn;
    echo "You rolled a $turn!\n";
} while (strtolower(readline("Roll again? ('y' - yes, 'n' - no) ")[0]) === "y");
echo "You got $totalPoints points." . PHP_EOL;