<?php

namespace App\Services\Rating;

use App\Repositories\History\HistoryRepository;
use Exception;

class PhotoResetService
{
    private HistoryRepository $historyRepository;

    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    /**
     * @throws Exception
     */
    public function resetHistory(int $id): void
    {
        try {
            $this->historyRepository->resetHistoryById($id);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}