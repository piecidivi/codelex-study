<?php

namespace App;

class RegularTrade implements Trade
{
    // Returns boolean to permit flower transfer
    public function pay(Shop $shop): bool
    {
        return Game::piglet($shop);
    }
}