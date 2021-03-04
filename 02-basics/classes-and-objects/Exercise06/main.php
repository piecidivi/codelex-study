<?php

require_once "Survey.php";

// Create instance
try {
    $surveyed = new Survey(12467, 0.14, 0.64);
} catch (InvalidArgumentException $exception) {
    echo $exception->getMessage();
}

// Retrieve data
if (isset($surveyed)) {
    echo "Total number of people surveyed: {$surveyed->getSurveyed()}.\n";
    echo "Approximately {$surveyed->getEnergyDrinksRate()} bought at least one energy drink.\n";
    echo "{$surveyed->getCitrusDrinksRate()} of those prefer flavored energy drinks.\n";
}