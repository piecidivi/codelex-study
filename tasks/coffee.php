<?php

// SHORT DESCRIPTION
// -> Based on money in wallet user can select all options, some options or is exited with message "not enough money".
// -> On selection user is asked to pay by choosing from available coins -> selecting "key": 200, 100 etc.
// -> If overpaid, machine returns coins.
// -> User can repeat to select another drink. However, money reduction will lead to fewer options to select from.

/* CLASS WALLET **********/

class Wallet
{
    private int $totalMoney = 0;
    private array $coins = [
        200 => 2, 100 => 1, 50 => 1, 20 => 2,
        10 => 2, 5 => 3, 2 => 5, 1 => 15
    ];

    public function __construct()
    {
        foreach ($this->coins as $coinIndex => $coinValue) {
            $this->totalMoney += $coinIndex * $coinValue;   // Count total money based on coins in wallet
        }
    }

    public function getTotalMoney(): int
    {
        return $this->totalMoney;
    }

    public function getCoins(): array
    {
        return $this->coins;
    }

    public function validateCoinSelection(int $coinIndex): bool
    {
        return array_key_exists($coinIndex, $this->coins) && $this->coins[$coinIndex] > 0;
    }

    public function removeCoinFromWallet(int $coinIndex): void
    {
        $this->coins[$coinIndex]--;
        $this->totalMoney -= $coinIndex;
    }

    public function refundChange(int $change): array
    {
        $this->totalMoney += $change;
        $refundCoins = [];
        while ($change > 0) {
            switch (true) {
                case $change >= 200:
                    $this->coins[200]++;
                    $change -= 200;
                    $refundCoins[] = 200;
                    break;
                case $change >= 100:
                    $this->coins[100]++;
                    $change -= 100;
                    $refundCoins[] = 100;
                    break;
                case $change >= 50:
                    $this->coins[50]++;
                    $change -= 50;
                    $refundCoins[] = 50;
                    break;
                case $change >= 20:
                    $this->coins[20]++;
                    $change -= 20;
                    $refundCoins[] = 20;
                    break;
                case $change >= 10:
                    $this->coins[10]++;
                    $change -= 10;
                    $refundCoins[] = 10;
                    break;
                case $change >= 5:
                    $this->coins[5]++;
                    $change -= 5;
                    $refundCoins[] = 5;
                    break;
                case $change >= 2:
                    $this->coins[2]++;
                    $change -= 2;
                    $refundCoins[] = 2;
                    break;
                default:
                    $this->coins[1]++;
                    $change -= 1;
                    $refundCoins[] = 1;
            }
        }
        return $refundCoins;
    }


} // End of Wallet class
/* END OF WALLET CLASS **********/


/* CLASS COFFEE **********/

class Coffee
{
    private array $coffeeOptions = ["Latte", "Melna Kafija",
        "Balta Kafija", "Cappuccino", "Frappuccino"];
    private array $coffeePrice = [220, 151, 185, 245, 237];
    private array $coffeeAvailableOptions = [];      // Based on money in Wallet vs option price
    private int $priceToPay;


    public function getCoffeeOptions(): array
    {
        return $this->coffeeOptions;
    }

    public function getCoffeePrice(): array
    {
        return $this->coffeePrice;
    }

    public function getCoffeeAvailableOptions(): array
    {
        return $this->coffeeAvailableOptions;
    }

    public function setPriceToPay(int $selection): void
    {
        $this->priceToPay = $this->coffeePrice[$selection];
    }

    public function getPriceToPay(): int
    {
        return $this->priceToPay;
    }

    public function validateOptionSelection(int $selection): bool
    {
        return in_array($selection, $this->coffeeAvailableOptions);
    }

    public function reducePriceToPay(int $coinIndex): void
    {
        $this->priceToPay -= $coinIndex;
    }

    public function isMoneyEnough(int $money): array
    {
        foreach ($this->coffeePrice as $priceIndex => $priceValue) {
            if ($priceValue <= $money) {
                $this->coffeeAvailableOptions[] = $priceIndex;
            }
        }
        return $this->coffeeAvailableOptions;
    }

} // End of Coffee class
/* END OF COFFEE CLASS **********/

/* APPLICATION FUNCTIONS **********/
function menu(Wallet $wallet, Coffee $coffee): string
{
    $output = "-------" . PHP_EOL;
    $output .= "Wallet: ";
    $output .= drawCoins($wallet->getCoins());
    $output .= "Wallet total: " . number_format($wallet->getTotalMoney() / 100, 2, ".", "") . PHP_EOL;
    $output .= "-------" . PHP_EOL;
    $output .= "Coffee: " . PHP_EOL;
    foreach ($coffee->getCoffeeOptions() as $key => $option) {
        if (in_array($key, $coffee->getCoffeeAvailableOptions())) {
            $output .= " [" . ($key + 1) . "] " . $option;
        } else {
            $output .= " [X] " . $option;
        }
        (strlen($option) > 10) ? $output .= "\t" : $output .= "\t\t";
        $output .= number_format(($coffee->getCoffeePrice()[$key] / 100), 2, ".", "") . PHP_EOL;
    }
    return $output;
}

function coffeeSelection(Coffee $coffee): int
{
    $selection = intval(readline("Please choose number: ")) - 1; // Array index for matching element is minus 1.
    // In method in_array will return false, when not found, so we need to negate (!) to keep while running.
    while (!$coffee->validateOptionSelection($selection)) {
        $selection = intval(readline("Wrong option selected. Please choose again: ")) - 1;
    }
    $coffee->setPriceToPay($selection);
    return $selection;
}

function coinSelection(Wallet $wallet): int
{
    $coinIndex = intval(readline("Please choose coin: "));
    while (!$wallet->validateCoinSelection($coinIndex)) {
        $coinIndex = intval(readline("Wrong selection. Please choose again: "));
    }
    return $coinIndex;
}


function payForCoffee(Coffee $coffee, Wallet $wallet): void
{
    echo "Coins available: " . drawCoins($wallet->getCoins());
    $coinIndex = coinSelection($wallet);
    $coffee->reducePriceToPay($coinIndex);
    $wallet->removeCoinFromWallet($coinIndex);
}

// Will print out 1 cent -> 1 coin / 2 coins; 5 cents -> 1 coin / 2 coins.
function drawCoins(array $coins): string
{
    $output = "";
    foreach ($coins as $coinIndex => $coinValue) {
        if ($coinValue > 1) {
            $coinIndex === 1 ? $output .= "$coinIndex cent -> {$coinValue} coins; " : $output .= "$coinIndex cents -> {$coinValue} coins; ";
        }
        if ($coinValue === 1) {
            $coinIndex === 1 ? $output .= "$coinIndex cent -> {$coinValue} coin; " : $output .= "$coinIndex cents -> {$coinValue} coin; ";
        }
    }
    return substr($output, 0, -2) . PHP_EOL;
}

/* END OF APPLICATION FUNCTIONS **********/


/* APPLICATION RUN **********/
// Wallet is initialized only once to maintain actual money after each coffee.
// Coffee is initialized every time inside do {} to refresh options based on money left.
$wallet = new Wallet();

// Run program
do {
    $coffee = new Coffee();

    // Check if money enough to buy a drink.
    $enoughMoney = $coffee->isMoneyEnough($wallet->getTotalMoney());

    // Draw menu
    echo menu($wallet, $coffee);
    if (count($enoughMoney) < 1) {  // Interrupts program
        exit("Not enough money to buy any drink." . PHP_EOL);
    }

    // Select drink
    $selection = coffeeSelection($coffee);

    // Pay for drink
    echo PHP_EOL . "You chose {$coffee->getCoffeeOptions()[$selection]}" . PHP_EOL .
        "Please pay: " . number_format($coffee->getCoffeePrice()[$selection] / 100, 2, ".", "") . PHP_EOL;
    payForCoffee($coffee, $wallet);

    // Keep paying till fully paid
    while ($coffee->getPriceToPay() > 0) {
        echo PHP_EOL . "Still to pay: " . number_format($coffee->getPriceToPay() / 100, 2, ".", "") . PHP_EOL;
        payForCoffee($coffee, $wallet);
    };

    // Return some coins, and enjoy drink
    echo PHP_EOL . "Money to return: " .
        number_format((abs($coffee->getPriceToPay())) / 100, 2, ".", "") . PHP_EOL;

    $refund = array_count_values($wallet->refundChange(abs($coffee->getPriceToPay())));
    if (count($refund) > 0) {
        echo "Returning in coins: " . drawCoins($refund);
    }
    echo "Total balance left: " . number_format($wallet->getTotalMoney() / 100, 2, ".", "") . PHP_EOL;
    echo "Coins in wallet: " . drawCoins($wallet->getCoins()) . PHP_EOL;
    echo "Please enjoy Your drink!" . PHP_EOL;

} while (strtolower(readline("Would You like to select another drink ('y' - yes, 'n' - no)? ")[0]) === "y");
exit("See You soon!" . PHP_EOL);
/* END OF APPLICATION RUN **********/