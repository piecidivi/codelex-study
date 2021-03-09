<?php


interface Trade
{
    public function pay(Shop $shop): bool;
}