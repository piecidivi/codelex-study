<?php

// 04 - LOOPS
// Exercise 1
$integers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
foreach ($integers as $integer) {
    echo "$integer ";
}
echo PHP_EOL;

// Exercise 2
$integers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
for ($i = 0; $i < count($integers); ++$i) {
    echo "$integers[$i] ";
}
echo PHP_EOL;

// Exercise 3
$x = 1;
while ($x < 10) {
    echo "codelex ";
    ++$x;
}
echo PHP_EOL;

// Exercise 4
$integers = [];
for ($i = 0; $i < 31; ++$i) {
    array_push($integers, $i);
}
foreach ($integers as $integer) {
    if ($integer % 3 === 0) {
        echo "$integer ";
    }
}
echo PHP_EOL;

// Exercise 5
$gvate = new stdClass();
$gvate->name = "Gvate";
$gvate->surname = "Mala";
$gvate->age = 28;
$gvate->birthday = "March 18";

$hondu = new stdClass();
$hondu->name = "Hondu";
$hondu->surname = "Rasa";
$hondu->age = 25;
$hondu->birthday = "April 21";

$nika = new stdClass();
$nika->name = "Nika";
$nika->surname = "Ragva";
$nika->age = 35;
$nika->birthday = "September 2";

$ne = new stdClass();
$ne->name = "Ne";
$ne->surname = "Pāla";
$ne->age = 22;
$ne->birthday = "November 14";

$persons = [$gvate, $hondu, $nika, $ne];

foreach ($persons as $person) {
    echo "{$person->name} {$person->surname}, {$person->age}, {$person->birthday}" . PHP_EOL;
}
