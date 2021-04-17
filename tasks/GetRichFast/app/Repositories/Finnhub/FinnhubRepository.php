<?php

namespace App\Repositories\Finnhub;

interface FinnhubRepository
{
    public function apiQuote(string $searchKey): float;
}