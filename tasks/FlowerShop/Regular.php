<?php


class Regular extends Warehouse implements Trade
{
    public function obtainFlowers(): array {
        return [1];
    }
}