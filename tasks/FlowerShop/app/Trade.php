<?php

namespace App;

interface Trade
{
    public function pay(Shop $shop): bool;
}