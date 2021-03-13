<?php

namespace App;

class Application
{
    // Initialize wholesalers
    public function initWholesaler(string $name, Shop $shop): object
    {
        $flowerNames = $shop->getFlowerNames();
        $seller = new Warehouse($name);
        while (count($flowerNames) > 3) {
            $flowerName = array_rand($flowerNames);
            $seller->addOneFlower(new Flower($flowerNames[$flowerName], mt_rand(50, 100)));
            unset($flowerNames[$flowerName]);
        }
        return $seller;
    }

    // Money is multiplied by 100 already here (before accessing other objects)
    public function initShop(): object
    {
        $shop = new Shop("Flowers Round The Corner - F.R.T.C.", 100000);
        $shop->addFlowers([
            new Flower("rose", 0, 500),
            new Flower("tulip", 0, 300),
            new Flower("gerber", 0, 400),
            new Flower("carnation", 0, 550),
            new Flower("daisy", 0, 250),
            new Flower("narcissus", 0, 350),
            new Flower("aster", 0, 275),
            new Flower("dahlia", 0, 335)
        ]);
        return $shop;
    }

    public function buyWholesale(int $wholesaler, Shop $shop): bool
    {
        switch ($wholesaler) {
            case 1:
                $game = new SillyTrade;
                break;
            case 2:
                $game = new RegularTrade;
                break;
            default:
                $game = new HustleTrade;
                break;
        }
        return ($this->executeTrade($game, $shop));
    }


    private function executeTrade(Trade $trade, Shop $shop): bool
    {
        return $trade->pay($shop);
    }


    public function inputValidation(int $lowerSelection, int $upperSelection): int
    {
        $menuSelection = intval(trim(readline("Please choose: ")));
        while ($menuSelection < $lowerSelection || $menuSelection > $upperSelection) {
            $menuSelection = intval(trim(readline("Wrong selection. Please repeat: ")));
        }
        return $menuSelection;
    }

    public function calculateCheckout(array $amount, array $price, bool $discount): array
    {
        $totalPay = $total = 0;
        for ($i = 0; $i < count($amount); ++$i) {
            $totalPay += ($amount[$i] * $price[$i]);
        }
        $total = $discount ? ($totalPay - ($totalPay * 0.2)) : $totalPay;
        return [$totalPay, $total];
    }
}