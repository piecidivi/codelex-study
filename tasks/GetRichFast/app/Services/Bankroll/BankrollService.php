<?php

namespace App\Services\Bankroll;

use App\Repositories\Balance\BankrollRepository;

class BankrollService
{
    private BankrollRepository $bankrollRepository;

    public function __construct(BankrollRepository $bankrollRepository)
    {
        $this->bankrollRepository = $bankrollRepository;
    }

    public function getById(int $bankrollId): array
    {
        return $this->bankrollRepository->getById($bankrollId)->jsonSerialize();
    }
}