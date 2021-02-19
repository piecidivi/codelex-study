<?php

$iterator = $lowerBound = 1;
$upperBound = 100;
$sum = $average = 0;

if ($lowerBound <= $upperBound) {
    while ($iterator <= $upperBound) {
        $sum += $iterator;
        $iterator++;
    }
    $average = $sum / ($upperBound - $lowerBound + 1);
    echo "The sum of $lowerBound to $upperBound is $sum" . PHP_EOL;
    echo sprintf("The average is %.1f", $average) . PHP_EOL;
} else {
    echo "Wrong boundaries provided." . PHP_EOL;
}

