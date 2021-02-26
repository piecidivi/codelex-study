<?php

class Product
{
    private string $name;
    private float $price;
    private string $currency;
    private int $amount;

    public function __construct(string $name, string $priceAtStart, string $amountAtStart)
    {
        $this->name = $name;
        $this->price = floatval(explode(" ", $priceAtStart)[0]);
        $this->currency = explode(" ", $priceAtStart)[1];
        $this->amount = intval(explode(" ", $amountAtStart)[0]);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function printProduct(): string
    {
        return $this->name . ", price " .
            number_format($this->price, 2, ".", ",") .
            " " . $this->currency .
            ", amount " . $this->amount;
    }

    public function setPrice(string $price): void
    {
        if (strlen($price) < 1) {
            return;
        }
        $this->price = floatval(explode(" ", $price)[0]);
        if (isset(explode(" ", $price)[1])) {
            $this->currency = explode(" ", $price)[1];
        }
    }

    public function setAmount(string $amount): void
    {
        if (strlen($amount) < 1) {
            return;
        }
        $this->amount = intval(explode(" ", $amount)[0]);
    }
}

$product1 = new Product("Logitech mouse", "70.00 EUR", "14 units");
$product2 = new Product("iPhone 5s", "999.99 EUR", "3 units");
$product3 = new Product("Epson EB-U05", "440.46 EUR", "1 units");

echo $product1->printProduct() . PHP_EOL;
echo $product2->printProduct() . PHP_EOL;
echo $product3->printProduct() . PHP_EOL;

$product1->setAmount(readline("Please enter new amount for product {$product1->getName()}: "));
$product2->setPrice(readline("Please enter new price for product {$product2->getName()}: "));

echo $product1->printProduct() . PHP_EOL;
echo $product2->printProduct() . PHP_EOL;
echo $product3->printProduct() . PHP_EOL;