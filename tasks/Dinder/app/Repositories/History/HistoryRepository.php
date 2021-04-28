<?php

namespace App\Repositories\History;

use App\Models\History;
use App\Models\HistoryCollection;

interface HistoryRepository
{
    public function addRecord(History $history, int $userid): void;

    public function getHistoryByUserId(int $userid): HistoryCollection;

    public function resetHistoryById(int $userid): void;
}