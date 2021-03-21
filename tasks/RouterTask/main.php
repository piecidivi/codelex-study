<?php

require_once "vendor/autoload.php";

use App\Models\ProdsAll;

$products = new ProdsAll();
$out = $products->getProducts();

foreach ($out as $product) {
    echo "{$product->getName()}, {$product->getPrice()}, {$product->getAmount()}\n";
}