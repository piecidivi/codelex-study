<?php

require_once "Date.php";

// Function to validate input before creating class instance
function validateInput(string $requirement): string
{
    do {
        $input = (readline("Please enter positive number other than 0 for $requirement: "));
    } while (!is_int($input) && (int)$input < 1);
    return $input;
}

// Insert values
$day = intval(validateInput("day"));
$month = intval(validateInput("month"));
$year = intval(validateInput("year"));

// Create object
try {
    $date = new Date($day, $month, $year);
} catch (InvalidArgumentException $exception) {
    echo $exception->getMessage();
}

// Display date saved in object
if (isset($date)) echo $date->displayDate();


if (isset($date)) {
    // Change date of object
    echo "\nChange date\n";
    $day = intval(validateInput("day"));
    $month = intval(validateInput("month"));
    $year = intval(validateInput("year"));

    try {
        $date->setDate($day, $month, $year);
    } catch (InvalidArgumentException $exception) {
        echo $exception->getMessage();
    }

    // Display date saved in object
    echo $date->displayDate();
}