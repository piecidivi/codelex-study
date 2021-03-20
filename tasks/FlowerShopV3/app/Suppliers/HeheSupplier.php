<?php

namespace App\Suppliers;

use App\Product;
use App\ProductCollection;
use App\Sellables\Flower;
use App\Config;
use Medoo\Medoo;


class HeheSupplier implements Supplier
{
    private ProductCollection $products;
    private Medoo $database;

    public function __construct()
    {
        $this->products = new ProductCollection;

        $this->database = new Medoo([
            'database_type' => $_ENV["DB_TYPE"],
            'database_name' => $_ENV["DB_NAME"],
            'server' => $_ENV["DB_HOST"],
            'username' => $_ENV["DB_USER"],
            'password' => $_ENV["DB_PASSWORD"]
        ]);
        $this->addProducts();
    }

    private function addProducts(): void
    {
        $flowers = $this->database->select('products', [
            'name',
            'price',
            'amount'
        ]);

        foreach ($flowers as $flower) {
            $this->products->add(
                new Product(
                    new Flower($flower["name"]), $flower["price"]
                ),
                $flower["amount"]
            );
        }
    }

    public function products(): ProductCollection
    {
        return $this->products;
    }
}