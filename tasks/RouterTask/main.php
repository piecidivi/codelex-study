<?php

use App\Models\ProdsAll;

$prods = new ProdsAll();
$out = $prods->getProducts();

foreach ($out as $product) {
    echo "{$product->getName()}, {$product->getPrice()}. {$product->getAmount()}\n";
}