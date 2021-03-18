<?php


namespace App\Models;

use App\Models\Prods;

class ProdsAll
{
    private array $products = [];

    public function __construct()
    {
        if (($h = fopen(dirname(__DIR__, 1) . "/Storage/products.csv", "r")) !== false) {
            while (($line = fgetcsv($h, 1000, ",")) !== FALSE) {
                $this->products[] = new Prods($line[0], $line[1], $line[2]);
            }
            fclose($h);
        }
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}