<?php

class RollTwoDice
{
    private string $result = "";

    public function desiredDiceSum(int $desiredSum): string
    {

        do {
            $roll1 = mt_rand(1, 6);
            $roll2 = mt_rand(1, 6);
            $this->result .= "$roll1 and $roll2 = " . ($roll1 + $roll2) . PHP_EOL;
        } while (($roll1 + $roll2) !== $desiredSum);

        return $this->result;
    }
}

do {
    $desiredSum = intval(readline("Desired sum (2-12): "));
} while ($desiredSum < 2 || $desiredSum > 12);

$rollDice = new RollTwoDice();
echo $rollDice->desiredDiceSum($desiredSum);