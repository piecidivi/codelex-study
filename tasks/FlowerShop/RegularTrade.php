<?php


class RegularTrade implements Trade
{
    public function pay(Shop $shop): bool {
        return Game::piglet($shop);
    }
}