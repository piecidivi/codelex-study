<?php

namespace App\Services\Shares;

use App\Models\Share;
use App\Repositories\Finnhub\FinnhubRepository;
use App\Repositories\Shares\ShareRepository;
use Exception;

class GetShareService
{
    private ShareRepository $shareRepository;
    private FinnhubRepository $finnhubRepository;

    public function __construct(ShareRepository $shareRepository, FinnhubRepository $finnhubRepository)
    {
        $this->shareRepository = $shareRepository;
        $this->finnhubRepository = $finnhubRepository;
    }

    /**
     * @throws Exception
     */
    public function lookup(string $lookup): array
    {
        $quote = $this->finnhubRepository->apiQuote($lookup);
        if ($quote == 0) {
            throw new Exception("No such stock. Please try different");
        }
        $share = new Share($lookup);
        $share->setQuote($quote);
        return $share->jsonSerialize();
    }

    /**
     * @throws Exception
     */
    public function stock(): array
    {
        $shares = $this->shareRepository->getShares();
        foreach ($shares->shares() as $share) {
            /** @var Share $share */
            if ($share->status() === "open") {
                $quote = $this->finnhubRepository->apiQuote($share->symbol());
                if ($quote == 0) {
                    throw new Exception("No such stock. Please try different");
                }
                $share->setQuote($quote);
            }
        }
        return $shares->serialize();
    }
}