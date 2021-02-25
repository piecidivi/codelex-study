<?php

$number = intval(readline("Max value? "));

for ($i = 1; $i < $number + 1; ++$i) {
    switch (true) {
        case $i % 3 === 0 && $i % 5 === 0:
            echo "FizzBuzz ";
            break;
        case $i % 3 === 0:
            echo "Fizz ";
            break;
        case $i % 5 === 0:
            echo "Buzz ";
            break;
        default:
            echo "$i ";
    }
    if ($i % 20 === 0) {
        echo "\n";
    }
}