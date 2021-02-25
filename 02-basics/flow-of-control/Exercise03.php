<?php

$number = intval(readline("Enter positive integer: "));
while ($number < 0) {
    $number = intval(readline("Number not positive. Please enter again: "));
}

$digits = count(str_split($number));
echo "Number contains $digits " . ($digits < 10 ? "digit." : "digits.") . PHP_EOL;