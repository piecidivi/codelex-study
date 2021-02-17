<?php

$products = [
    [
        "id" => 1,
        "name" => "Tank",
        "price" => 1000
    ],
    [
        "id" => 2,
        "name" => "Car",
        "price" => 100
    ],
    [
        "id" => 3,
        "name" => "Bus",
        "price" => 200
    ],
    [
        "id" => 4,
        "name" => "Airplane",
        "price" => 800
    ],
    [
        "id" => 5,
        "name" => "Bike",
        "price" => 50
    ]
];

foreach ($products as $product) {
    echo "{$product["id"]} . {$product["name"]}, {$product["price"]}" . PHP_EOL;
}

$productOrdered = ucfirst(readline("Please choose product from list (by name): "));
$amountOrdered = intval(readline("Please choose amount (number): "));

if ($amountOrdered > 0) {
    $productMatched = 0;
    foreach ($products as $product) {
        if ($product["name"] === $productOrdered) {
            $productMatched = 1;
            $price = $product["price"] * $amountOrdered;
            if ($amountOrdered > 1) {
                $s = "s. Price: ";  // s at end of name if more than one ordered
            } else {
                $s = ". Price: ";
            }
            echo "Your order is to buy {$amountOrdered} {$product["name"]}{$s}{$price}" . PHP_EOL;
        }
    }
    if ($productMatched === 0) {
        echo "No product chosen or wrong product selected." . PHP_EOL;
    }
} else {
    echo "Amount for product to buy provided less than 1 or non-numerical." . PHP_EOL;
}