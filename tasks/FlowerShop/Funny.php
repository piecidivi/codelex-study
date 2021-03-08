<?php


class Funny extends Warehouse implements Trade
{
    public function obtainFlowers(): array {
        return [1];
    }
}