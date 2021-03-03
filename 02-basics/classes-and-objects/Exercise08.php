<?php

class SavingsAccount
{
    private int $balance;
    private int $annualInterestRate;
    private int $withdrawn = 0;
    private int $deposited = 0;
    private int $interest = 0;

    // Input floats are multiplied with 100, and saved and operated as integers.
    public function __construct(float $balance, int $annualInterestRate)
    {
        $this->balance = $balance * 100;
        $this->annualInterestRate = $annualInterestRate;
    }

    public function getBalance(): int
    {
        return $this->balance;
    }

    public function getDeposited(): int
    {
        return $this->deposited;
    }

    public function getWithdrawn(): int
    {
        return $this->withdrawn;
    }

    public function getInterestEarned(): int
    {
        return $this->interest;
    }

    public function withdrawal(float $withdrawAmount): void
    {
        $this->withdrawn += $withdrawAmount * 100;
        $this->balance -= $withdrawAmount * 100;
    }

    public function deposit(float $depositAmount): void
    {
        $this->deposited += $depositAmount * 100;
        $this->balance += $depositAmount * 100;
    }

    public function addMonthlyInterest(): void
    {
        $this->interest += ($this->balance * $this->annualInterestRate / 12);
        $this->balance += ($this->balance * $this->annualInterestRate / 12);
    }

} // END OF CLASS SAVINGS ACCOUNT


// Testing
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