<?php

require_once "vendor/autoload.php";

use App\Application;
use App\Warehouse;
use App\View;
use App\Shop;

// Initialize app
$app = new Application();
$view = new View();

$shop = $app->initShop();
/** @var Shop $shop */
$silly = $app->initWholesaler("Silly Warehouse", $shop);
$regular = $app->initWholesaler("Regular Warehouse", $shop);
$hustler = $app->initWholesaler("Hustler Warehouse", $shop);
/** @var Warehouse $silly */
/** @var Warehouse $regular */
/** @var Warehouse $hustler */

// Initialize UI
echo $view->welcomeNote();
do {
    echo $view->stockView($shop);
    $flowersInShop = $shop->getTotalAmount();
    echo $view->mainMenu($flowersInShop);

    $menuSelection = $flowersInShop > 0 ? $app->inputValidation(0, 4) :
        $app->inputValidation(0, 3);

    if ($menuSelection === 4) {
        // Sell flowers to customer
        $soldName = $soldAmount = $soldPrice = [];
        do {
            echo $view->customerView($shop);
            $flowerSelection = $app->inputValidation(1, count($shop->getAvailableFlowers())) - 1;    // iterator is + 1
            echo "Select amount. ";
            $flowerAmount = $app->inputValidation(1, $shop->getAvailableFlowers()[$flowerSelection]->getAmount());
            $soldName[] = $shop->getAvailableFlowers()[$flowerSelection]->getName();
            $soldAmount[] = $flowerAmount;
            $soldPrice[] = $shop->getAvailableFlowers()[$flowerSelection]->getPrice();
            $shop->deductAmount($shop->getAvailableFlowers()[$flowerSelection]->getName(), $flowerAmount);

            echo "[1] Select again, [2] Proceed to checkout. ";
            $selection = $app->inputValidation(1, 2);

        } while ($selection === 1 && count($shop->getAvailableFlowers()) > 0);
        if (count($shop->getAvailableFlowers()) < 1) {
            readline("There are no more flowers in stock at current time. Please press 'enter' to proceed to checkout. ");
        }
        echo "Is Your customer a lady? [1] YES, [2] NO. ";
        $lady = $app->inputValidation(1, 2);
        $checkOut = $app->calculateCheckout($soldAmount, $soldPrice, $lady);
        echo $view->checkOut($soldName, $soldAmount, $checkOut);
        $shop->addMoney($checkOut[1]);
        readline("Press 'enter' to continue: ");
    }

    if ($menuSelection > 0 && $menuSelection < 4) {
        if ($app->buyWholesale($menuSelection, $shop)) {
            switch ($menuSelection) {
                case 1:
                    $shop->transferFlowers($silly);
                    $silly = $app->initWholesaler("Silly Warehouse", $shop);
                    break;
                case 2:
                    $shop->transferFlowers($regular);
                    $regular = $app->initWholesaler("Regular Warehouse", $shop);
                    break;
                case 3:
                    $shop->transferFlowers($hustler);
                    $hustler = $app->initWholesaler("Hustler Warehouse", $shop);
            }
        }
    }
} while ($menuSelection !== 0);