<?php

namespace App\Suppliers;

use App\Product;
use App\ProductCollection;
use App\Sellables\Flower;

class CoolGardenSupplier implements Supplier
{
    private ProductCollection $products;

    public function __construct()
    {
        $this->products = new ProductCollection;
        $this->readJson();
    }

    private function readJson(): void
    {
        $json = file_get_contents(dirname(__DIR__, 1) . "/Storage/cool-garden-storage.json");
        $flowers = json_decode($json);

        foreach ($flowers as $flower) {
            $this->products->add(
                new Product(
                    new Flower($flower->name), $flower->price
                ),
                $flower->amount
            );
        }
    }

    public function products(): ProductCollection
    {
        return $this->products;
    }
}