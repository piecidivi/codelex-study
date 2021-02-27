<?php

class SlotMachine
{
    private array $combo = [];
    private array $elements = [     // Values have to be integers, otherwise Cashier will have errors.
        "Q" => 10,
        "W" => 20,
        "X" => 30,
        "Y" => 40,
        "Z" => 50
    ];

    public function getCombo(): array
    {
        return $this->combo;
    }

    public function makeCombo(): void
    {
        $this->combo = [];
        for ($i = 0; $i < 9; ++$i) {
            $this->combo[] = array_rand($this->elements);
        }
    }

    public function winningCombos(): array
    {
        $win = [];

        if ($this->compareValues(0, 1, 2)) {
            $win[] = $this->elements[$this->combo[0]];
        }
        if ($this->compareValues(3, 4, 5)) {
            $win[] = $this->elements[$this->combo[3]];
        }
        if ($this->compareValues(6, 7, 8)) {
            $win[] = $this->elements[$this->combo[6]];
        }
        if ($this->compareValues(0, 4, 8)) {
            $win[] = $this->elements[$this->combo[0]];
        }
        if ($this->compareValues(2, 4, 6)) {
            $win[] = $this->elements[$this->combo[2]];
        }
        return $win;
    }

    private function compareValues(int $el1, int $el2, int $el3): bool
    {
        return $this->combo[$el1] === $this->combo[$el2] &&
            $this->combo[$el2] === $this->combo[$el3];
    }
}