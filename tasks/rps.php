<?php

$validOptions = ["r", "p", "s"];

function chooseWinner(string $userChoice, string $computerChoice, array $validOptions): int
{
    return abs(array_search($userChoice, $validOptions) - array_search($computerChoice, $validOptions)) === 1 ?
        max(array_search($userChoice, $validOptions), array_search($computerChoice, $validOptions)) :
        min(array_search($userChoice, $validOptions), array_search($computerChoice, $validOptions));
}

$userChoice = strtolower(readline("Choose from (rock - r, paper - p, or scissors - s): "));
$computerChoice = $validOptions[array_rand($validOptions, 1)];  // returns value of array element
echo "Computer chose: $computerChoice" . PHP_EOL;

if (in_array($userChoice, $validOptions)) {
    if ($userChoice === $computerChoice) {
        echo "It is a tie!" . PHP_EOL;
        return;
    }
    echo $userChoice === $validOptions[chooseWinner($userChoice, $computerChoice, $validOptions)] ?
        "Player wins!" . PHP_EOL : "Computer wins!" . PHP_EOL;
} else {
    echo "Invalid option selected!" . PHP_EOL;
}