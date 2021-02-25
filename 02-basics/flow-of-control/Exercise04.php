<?php

function dayNumber(int $dayNumber): string
{
    switch ($dayNumber) {
        case 0:
            return "Sunday";
        case 1:
            return "Monday";
        case 2:
            return "Tuesday";
        case 3:
            return "Wednesday";
        case 4:
            return "Thursday";
        case 5:
            return "Friday";
        case 6:
            return "Saturday";
        default:
            return "Not a valid day";
    }
}

$dayNumber = intval(readline("Enter day number: "));
echo dayNumber($dayNumber) . PHP_EOL;
