<?php

require_once "./SlotMachine.php";
require_once "./Cashier.php";

function drawBoard(SlotMachine $slots): void
{
    echo PHP_EOL;
    echo " {$slots->getCombo()[0]} {$slots->getCombo()[1]} {$slots->getCombo()[2]} " . PHP_EOL;
    usleep(1000000);
    echo " {$slots->getCombo()[3]} {$slots->getCombo()[4]} {$slots->getCombo()[5]} " . PHP_EOL;
    usleep(1000000);
    echo " {$slots->getCombo()[6]} {$slots->getCombo()[7]} {$slots->getCombo()[8]} " . PHP_EOL;
}

function betSize(Cashier $balance): int
{
    echo PHP_EOL;
    $betSize = intval(readline("Please choose bet size up to {$balance->getBetLimit()}x: "));
    while ($betSize > $balance->getBetLimit()) {
        $betSize = intval(readline("Bet size chosen exceeds money balance. Please choose again: "));
    };
    return $betSize;
}


// Starting menu
echo "Welcome to game of Slot Machine!" . PHP_EOL;
$balance = intval(readline("Please enter amount of money to play with (minimum 10): "));
while ($balance < 10) {
    $balance = intval(readline("Money to start with has to match at least one smallest bet total, which is 10: "));
}

$balance = new Cashier($balance);
$slots = new SlotMachine();
$balance->setBetSize(betSize($balance));


// Gameplay
do {
    $choice = "0";
    // Check if money left for at least minimum bet
    if ($balance->noMoney()) {
        echo "Not enough money to play!" . PHP_EOL;
        break;
    }

    // Allow to play with current bet if sufficient funds, else offer to change bet
    if ($balance->checkBalance()) {
        echo PHP_EOL;
        echo "Money: {$balance->getBalance()} Bet size: {$balance->getBetSize()} Total bet: {$balance->getTotalBet()}" . PHP_EOL;
        $choice = readline("[1] - Play, [2] - Change bet, [3] - Exit: ");
        switch (true) {
            case $choice === "1":
                $balance->deduct();
                $slots->makeCombo();
                drawBoard($slots);
                $win = $slots->winningCombos();
                echo "Won: " . $balance->add($win) . PHP_EOL;
                break;
            case $choice === "2":
                $balance->setBetSize(betSize($balance));
                break;
            default:
                return;
        }
    } else {
        echo PHP_EOL;
        echo "Money: {$balance->getBalance()} Bet size: {$balance->getBetSize()} Total bet: {$balance->getTotalBet()}" . PHP_EOL;
        echo "Not enough money to continue with this bet." . PHP_EOL;
        $balance->setBetSize(betSize($balance));
    }
} while ($choice !== "3");

echo "Thank You for playing with us!" . PHP_EOL;