<?php

$numbers = [
    1789, 2035, 1899, 1456, 2013,
    1458, 2458, 1254, 1472, 2365,
    1456, 2265, 1457, 2456
];

$number = readline("Enter the value to search for: ");
echo in_array($number, $numbers) ?
    "Element is present in array." . PHP_EOL :
    "Element is not present in array." . PHP_EOL;

//todo check if an array contains a value user entered
