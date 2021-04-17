<?php

namespace App\Services\Shares;

use App\Repositories\Balance\BankrollRepository;
use App\Repositories\Shares\ShareRepository;

class SellShareService
{
    private ShareRepository $shareRepository;
    private BankrollRepository $bankrollRepository;

    const INT_FLOAT_CONVERSION = 100;

    public function __construct(ShareRepository $shareRepository, BankrollRepository $bankrollRepository)
    {
        $this->shareRepository = $shareRepository;
        $this->bankrollRepository = $bankrollRepository;
    }

    public function sell(int $bankrollId, int $shareId, float $price): bool
    {
        $share = $this->shareRepository->getById($shareId);
        $share->setQuote($price);
        $bankroll = $this->bankrollRepository->getById($bankrollId);
        $price *= self::INT_FLOAT_CONVERSION;
        $bankroll->sell($share->amount(), $price);
        $share->sell();
        $this->bankrollRepository->update($bankroll);
        $this->shareRepository->updateOneShare($share);
        return true;
    }
}