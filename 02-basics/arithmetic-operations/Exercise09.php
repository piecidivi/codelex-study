<?php

echo "Find Body Mass Index for sedentary person" . PHP_EOL;
$weight = readline("Please enter Your weight (kg): ");
$height = readline("Please enter Your height (cm): ");

if (is_numeric($weight) && is_numeric($height) && $weight > 0 && $height > 0) {
    // Convert to imperial system
    $weight *= 2.2;
    $height *= 0.39;

    // Calculate BMI
    $bmi = $weight * 703 / $height ** 2;
    // echo $bmi . PHP_EOL;
    switch (true) {
        case $bmi < 18.5:
            echo "You are underweight." . PHP_EOL;
            break;
        case $bmi > 25:
            echo "You are overweight." . PHP_EOL;
            break;
        default:
            echo "Your weight is considered optimal." . PHP_EOL;
    }
} else {
    echo "Non-numeric or ambiguous values provided." . PHP_EOL;
}

