<?php

// 03 - ARRAY & OBJECTS
// Exercise 1
$numbers = [10, 20, 30];
echo array_sum($numbers) . PHP_EOL;

// Exercise 2
$person = [
    "name" => "John",
    "surname" => "Doe",
    "age" => 50
];
var_dump($person["name"], $person["surname"], $person["age"]);

// Exercise 3
$person = new stdClass();
$person->name = "John";
$person->surname = "Doe";
$person->age = 50;
var_dump($person->name, $person->surname, $person->age);

// Exercise 4
$items = [
    [
        [
            "name" => "John",
            "surname" => "Doe",
            "age" => 50
        ],
        [
            "name" => "Jane",
            "surname" => "Doe",
            "age" => 41
        ]
    ]
];
echo "{$items[0][1]["name"]} {$items[0][1]["surname"]} {$items[0][1]["age"]}" . PHP_EOL;

// Exercise 5
echo $items[0][0]["name"] . " & " . $items[0][1]["name"] . " " . $items[0][0]["surname"] . "`s" . PHP_EOL;
