<?php

// 02 - IF, ELSE, ELSEIF & SWITCH
// Exercise 1
if (10 === "10") {
    echo "same" . PHP_EOL;
} else {
    echo "different" . PHP_EOL;
}

// Exercise 2
$a = 50;
if ($a >= 1 && $a <= 100) {
    echo "in range" . PHP_EOL;
} else {
    echo "out of range" . PHP_EOL;
}

// Exercise 3
$string = "hello";
if ($string === "hello") {
    echo "world" . PHP_EOL;
}

// Exercise 4
$a = 2;
if (($a > 5 || $a < 5) && ($a % 2 === 0)) {
    echo "match even" . PHP_EOL;
}
else {
    echo "no match or odd" . PHP_EOL;
}

// Exercise 5
$v = 50;
$y = 40;
$z = 60;
if ($v >= $y && $v <= $z) {
    echo "correct" . PHP_EOL;
}

// Exercise 6
$plateNumber = "AB1234";
switch ($plateNumber) {
    case "AB1234":
        echo "This is Your car." . PHP_EOL;
        break;
    default:
        echo "This is not Your car." . PHP_EOL;
}

// Exercise 7
$number = 55;
switch (true) {
    case $number <= 50:
        echo "low" . PHP_EOL;
        break;
    case $number > 100:
        echo "high" . PHP_EOL;
        break;
    default:
        echo "medium" . PHP_EOL;
}

