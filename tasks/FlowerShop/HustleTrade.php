<?php


class HustleTrade implements Trade
{
    public function pay(Shop $shop): bool {
        return Game::guessNumber($shop);
    }
}