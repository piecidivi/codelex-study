<?php

require_once "SavingsAccount.php";

// Function to format output
function formatOutput(int $number): string
{
    $money = number_format($number / 100, 2, ".", ",");
    return "$$money";
}

// Form starting values
$startBalance = floatval(readline("How much money is in the account: "));
$annualInterestRate = intval(readline("Enter the annual interest rate: "));
$accountOpenedTime = intval(readline("How long has the account been opened: "));

// Form instance and run program
$balance = new SavingsAccount($startBalance, $annualInterestRate);
$iterator = 1;
while ($iterator <= $accountOpenedTime) {
    $balance->deposit(floatval(readline("Enter amount deposited for month $iterator: ")));
    $balance->withdrawal(floatval(readline("Enter amount withdrawn for month $iterator: ")));
    $balance->addMonthlyInterest();
    $iterator++;
}

// Output final values
echo "Total deposited:\t" . formatOutput($balance->getDeposited()) . PHP_EOL;
echo "Total withdrawn:\t" . formatOutput($balance->getWithdrawn()) . PHP_EOL;
echo "Interest earned:\t" . formatOutput($balance->getInterestEarned()) . PHP_EOL;
echo "Ending balance:\t\t" . formatOutput($balance->getBalance()) . PHP_EOL;