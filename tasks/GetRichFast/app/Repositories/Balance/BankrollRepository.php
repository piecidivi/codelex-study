<?php

namespace App\Repositories\Balance;

use App\Models\Bankroll;

interface BankrollRepository
{
    public function add(Bankroll $bankroll): void;

    public function getById(int $bankrollId): Bankroll;

    public function update(Bankroll $bankroll): void;
}