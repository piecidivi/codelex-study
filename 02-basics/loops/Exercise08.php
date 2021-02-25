<?php

class NumberSquare
{
    private string $result = "";

    public function square(int $min, int $max): string
    {
        $row = range($min, $max);
        $this->result .= implode("", $row) . PHP_EOL;
        for ($i = 0; $i < $max - $min; ++$i) {
            array_push($row, array_shift($row));
            $this->result .= implode("", $row) . PHP_EOL;
        }
        return $this->result;
    }
}

do {
    $min = intval(readline("Min? "));
    $max = intval(readline("Max? "));
} while ($min > $max);

$square = new NumberSquare();
echo $square->square($min, $max);
