<?php


class SavingsAccount
{
    private int $balance;
    private int $annualInterestRate;
    private int $withdrawn = 0;
    private int $deposited = 0;
    private int $interest = 0;

    // Input floats are multiplied with 100, and saved and operated as integers.
    // Interest rate is integer 5, not 0.05, defined it task requirements.
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
}