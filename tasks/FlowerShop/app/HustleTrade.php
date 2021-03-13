<?php

namespace App;

class HustleTrade implements Trade
{
    // Returns boolean to permit flower transfer
    public function pay(Shop $shop): bool
    {
        return Game::guessNumber($shop);
    }
}