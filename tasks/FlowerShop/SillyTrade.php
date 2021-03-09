<?php


class SillyTrade implements Trade
{
    // this retrieves flowers from warehouse
    public function pay(Shop $shop): bool {
        return Game::rps($shop);
    }
}