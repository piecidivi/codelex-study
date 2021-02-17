<?php

// 05 - FUNCTIONS
// Exercise 1
function addString(string $text): string
{
    return "$text codelex" . PHP_EOL;
}
echo addString("->");
echo PHP_EOL;

// Exercise 2
function multiply(int $base, int $multiplier): string
{
    return $base * $multiplier . PHP_EOL;
}
echo multiply(10, 5) . PHP_EOL;

// Exercise 3
function checkLegal(stdClass $person): bool
{
    return $person->age >= 18;
}

$person = new stdClass();
$person->name = "Pēteris";
$person->surname = "Zarāns";
$person->age = 40;

if (checkLegal($person)) {
    echo "{$person->name} has reached age of 18." . PHP_EOL;
} else {
    echo "{$person->name} has not reached age of 18." . PHP_EOL;
}
echo PHP_EOL;

// Exercise 4
$gvate = new stdClass();
$gvate->name = "Gvate";
$gvate->surname = "Mala";
$gvate->age = 18;
$gvate->birthday = "March 18";

$hondu = new stdClass();
$hondu->name = "Hondu";
$hondu->surname = "Rasa";
$hondu->age = 16;
$hondu->birthday = "April 21";

$nika = new stdClass();
$nika->name = "Nika";
$nika->surname = "Ragva";
$nika->age = 15;
$nika->birthday = "September 2";

$ne = new stdClass();
$ne->name = "Ne";
$ne->surname = "Pāla";
$ne->age = 22;
$ne->birthday = "November 14";

$persons = [$gvate, $hondu, $nika, $ne];

foreach ($persons as $person) {
    if (checkLegal($person)) {
        echo "{$person->name} has reached age of 18." . PHP_EOL;
    } else {
        echo "{$person->name} has not reached age of 18." . PHP_EOL;
    }
}
echo PHP_EOL;

// Exercise 5
function checkWeight(int $weight): string
{
    return $weight > 10 ? "2" : "1";
}

$fruits = [
    [
        "name" => "Apple",
        "weight" => 11
    ],
    [
        "name" => "Banana",
        "weight" => 9
    ]
];

$shippingCost = [
    "1" => 1,
    "2" => 2
];

foreach ($fruits as $fruit) {
    echo "Shipping cost of {$fruit["name"]} is {$shippingCost[checkWeight($fruit["weight"])]} EUR" . PHP_EOL;
}
echo PHP_EOL;

// Exercise 6
$elements = ["22.4", 5, 10, 18.2, 45];

function doubleIntegers(int $element): int
{
    return $element * 2;
}

for ($i = 0; $i < count($elements); ++$i) {
    if (gettype($elements[$i]) === "integer") {
        echo doubleIntegers($elements[$i]) . " ";
    } else {
        echo $elements[$i] . " ";
    }
}
echo PHP_EOL . PHP_EOL;

// Exercise 6v2 - Ja nu pēkšņi vajadzēja ar array_map, bet tad es nezinu, kādu "type hint" un "return type" likt.
$elements = ["22.4", 5, 10, 18.2, 45];

function doubleIntegersOnly($element)
{
    return gettype($element) === "integer" ? $element * 2 : $element;
}

$elements = array_map("doubleIntegersOnly", $elements);

for ($i = 0; $i < count($elements); ++$i) {
    echo "{$elements[$i]} ";
}
echo PHP_EOL . PHP_EOL;

// Exercise 7
$person = new stdClass();
$person->name = "Pēteris";
$person->gunLicenses = ["G", "B"];
$person->cash = 500;

$guns = [
    [
        "license" => "B",
        "name" => "Beretta",
        "price" => 340
    ],
    [
        "license" => "F",
        "name" => "FN",
        "price" => 400
    ],
    [
        "license" => "G",
        "name" => "GLOCK",
        "price" => 550

    ]
];

foreach ($guns as $gun) {
    if (in_array($gun["license"], $person->gunLicenses) && $gun["price"] <= $person->cash) {
        echo "{$person->name} can buy a {$gun["name"]} from store." . PHP_EOL;
    }
}

