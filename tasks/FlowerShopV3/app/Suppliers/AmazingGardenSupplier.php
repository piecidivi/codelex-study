<?php

namespace App\Suppliers;

use App\Product;
use App\ProductCollection;
use App\Sellables\Flower;

class AmazingGardenSupplier implements Supplier
{
    private ProductCollection $products;

    public function __construct()
    {
        $this->products = new ProductCollection;
        $this->readCsv();
    }

    private function readCsv(): void
    {
        if (($h = fopen(dirname(__DIR__, 1) . "/Storage/amazing-garden-storage.csv", "r")) !== false) {
            while (($line = fgetcsv($h, 1000, ",")) !== FALSE) {
                $this->products->add(
                    new Product(
                        new Flower($line[0]), $line[1]
                    ),
                    $line[2]
                );
            }
            fclose($h);
        }
    }

    public function products(): ProductCollection
    {
        return $this->products;
    }
}