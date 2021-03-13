<?php

namespace App;

class View
{
    public function welcomeNote(): string
    {
        $string = "Welcome to Flower Shop application. Here You can obtain flowers from wholesalers and sell to customers.\n";
        $string .= "\nIn order to obtain flowers from seller You have to play game.\n";
        $string .= "\"Silly\" will charge 500.00 for every move in game of Rock, Paper, Scissors.\n";
        $string .= "\"Regular\" will charge 200.00 for every move in game of Piglet.\n";
        $string .= "\"Hustler\" will charge 100.00 for every try at Guessing the number 1-10.\n";
        $string .= "At any point in time You can quit the game. However, only winning the game will bring You flowers!\n";
        $string .= "With 0 flowers in shop You can not sell to customers.\n";
        return $string;
    }

    public function stockView(Shop $shop): string
    {
        $string = "\n{$shop->getName()}\n" . str_repeat("-", strlen($shop->getName()) + 5) . "\n";
        $string .= "FLOWER\t\tAMOUNT\t\tPRICE\n";

        foreach ($shop->getFlowers() as $flower) {
            /** @var Flower $flower */
            $tab = strlen($flower->getName()) < 7 ? "\t\t" : "\t";
            $price = number_format($flower->getPrice() / 100, 2);
            $string .= "{$flower->getName()}{$tab}{$flower->getAmount()}\t\t{$price}\n";
        }
        $balance = number_format($shop->getBalance() / 100, 2);
        $string .= str_repeat("-", strlen($shop->getName()) + 5) . "\n";
        $string .= "Shop balance is: $balance\n";
        return $string;
    }

    public function customerView(Shop $shop): string
    {
        $iterator = 1;
        $string = "\n{$shop->getName()}\n" . str_repeat("-", strlen($shop->getName()) + 5) . "\n";
        $string .= "FLOWER\t\tAMOUNT\t\tPRICE\n";

        foreach ($shop->getAvailableFlowers() as $flower) {
            /** @var Flower $flower */
            $tab = (strlen($flower->getName()) + 4) < 7 ? "\t\t" : "\t";
            $price = number_format($flower->getPrice() / 100, 2);
            $string .= "[{$iterator}] {$flower->getName()}{$tab}{$flower->getAmount()}\t\t{$price}\n";
            $iterator++;
        }
        return $string;
    }

    public function mainMenu(int $totalAmount): string
    {
        if ($totalAmount < 1) {
            $string = "\nNo flowers to sell to customer\n";
            $string .= "[0] EXIT\n";
            $string .= "Select wholesaler [1] Silly, [2] Regular, [3] Hustler\n";
        } else {
            $string = "\n[0] EXIT\n";
            $string .= "Select wholesaler [1] Silly, [2] Regular, [3] Hustler\n";
            $string .= "[4] Sell to customer\n";
        }
        return $string;
    }

    public function checkOut(array $name, array $amount, array $checkOut): string
    {
        $string = "\nYou have sold to customer:\n";
        for ($i = 0; $i < count($name); ++$i) {
            $tab = strlen($name[$i]) < 7 ? "\t\t" : "\t";
            $string .= "{$name[$i]}{$tab}{$amount[$i]}\n";
        }
        $number = number_format($checkOut[0] / 100, 2);
        $string .= "For initial value of $number\n";
        if ($checkOut[0] !== $checkOut[1]) {
            $string .= "Discount for customer being a lady is 20%\n";
        }
        $number = number_format($checkOut[1] / 100, 2);
        $string .= "Total money received is $number\n";
        return $string;
    }
}