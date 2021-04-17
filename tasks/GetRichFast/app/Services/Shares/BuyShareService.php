<?php

namespace App\Services\Shares;

use App\Models\Share;
use App\Repositories\Balance\BankrollRepository;
use App\Repositories\Shares\ShareRepository;

class BuyShareService
{
    private ShareRepository $shareRepository;
    private BankrollRepository $bankrollRepository;

    const INT_VAL_CONVERSION = 100;

    public function __construct(ShareRepository $shareRepository, BankrollRepository $bankrollRepository)
    {
        $this->shareRepository = $shareRepository;
        $this->bankrollRepository = $bankrollRepository;
    }

    public function buy(int $bankrollId, string $symbol, int $amount, float $price): bool
    {
        $price *= self::INT_VAL_CONVERSION;
        $bankroll = $this->bankrollRepository->getById($bankrollId);
        $bankroll->buy($amount, $price);
        $share = new Share($symbol, $amount, $price);
        $this->bankrollRepository->update($bankroll);
        $this->shareRepository->addShare($share);
        return true;
    }
}