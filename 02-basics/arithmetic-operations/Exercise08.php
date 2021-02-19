<?php

class Employee
{
    private string $employee;
    private float $basePay;
    private int $hoursWorked;
    private float $totalPay = 0;

    function __construct(string $employee, float $basePay, int $hoursWorked)
    {
        $this->employee = $employee;
        $this->basePay = $basePay;
        $this->hoursWorked = $hoursWorked;
    }

    public function checkComplianceAndCalculatePay(): float
    {
        if ($this->basePay < 8.00 || $this->hoursWorked > 60) {
            throw new Exception("Base pay lower than $8.00 or hours worked more than 60.\n");
        }
        return $this->calculatePay();
    }

    private function calculatePay(): float
    {
        if ($this->hoursWorked > 40) {
            $this->totalPay += ($this->hoursWorked - 40) * $this->basePay * 1.5;
        }
        $this->totalPay += 40 * $this->basePay;
        return $this->totalPay;
    }

}

$employees = [
    new Employee("Employee 1", 7.50, 35),
    new Employee("Employee 2", 8.20, 47),
    new Employee("Employee 3", 10.00, 73),
    new Employee("Employee 4", 9.23, 49),
    new Employee("Employee 5", 10.50, 61)
];


foreach ($employees as $employee) {
    try {
        printf("%.2f", $employee->checkComplianceAndCalculatePay());
        echo PHP_EOL;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}