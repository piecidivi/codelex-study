<?php


class Date
{
    private int $day;
    private int $month;
    private int $year;

    public function __construct(int $day, int $month, int $year)
    {
        $this->setDate($day, $month, $year);
    }

    // This method was required in task details
    public function displayDate(): string
    {
        $str = "Saved date in form dd/mm/yyyy is ";
        $str .= "{$this->outputFormat($this->day)}/";
        $str .= "{$this->outputFormat($this->month)}/";
        $str .= "{$this->year}.\n";
        return $str;
    }

    private function outputFormat(int $outputValue): string
    {
        if (strlen((string)$outputValue) < 2) {
            return "0{$outputValue}";
        } else {
            return "$outputValue";
        }
    }

    public function setDate(int $day, int $month, int $year): void
    {
        if (!$this->validateMonth($month) || !$this->validateDay($day, $month, $year)) {
            throw new InvalidArgumentException("Impossible day or month provided for given combination!\n");
        }
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
    }

    private function validateMonth(int $month): bool
    {
        return $month <= 12;
    }

    private function validateDay(int $day, int $month, int $year): bool
    {
        return $day <= $this->calculateMonthLength($month, $year);
    }

    private function calculateMonthLength(int $month, int $year): int
    {
        switch (true) {
            case $month === 2:
                $this->calculateLeapYear($year) ? $dayCount = 29 : $dayCount = 28;
                break;
            case in_array($month, [4, 6, 9, 11]):
                $dayCount = 30;
                break;
            default:
                $dayCount = 31;
        }
        return $dayCount;
    }

    private function calculateLeapYear(int $year): bool
    {
        return $year % 4 === 0 && $year % 100 !== 0 ? true : $year % 400 === 0;
    }
}