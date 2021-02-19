<?php

function compareIntegers(int $number1, int $number2): bool
{
    return $number1 === 15 ||
        $number2 === 15 ||
        $number1 + $number2 === 15 ||
        abs($number1 - $number2) === 15;
}

echo "Integers to compare" . PHP_EOL;
$number1 = readline("Please enter first number: ");
$number2 = readline("Please enter second number: ");

if (is_numeric($number1) && is_numeric($number2) &&
    gettype($number1 + 0) === "integer" &&
    gettype($number2 + 0) === "integer") {
    echo compareIntegers($number1, $number2) ? "True!" : "False!";
    echo PHP_EOL;
} else {
    echo "One or more of numbers is not integer." . PHP_EOL;
}
