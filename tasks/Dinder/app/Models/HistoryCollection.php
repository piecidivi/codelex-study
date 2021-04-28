<?php

namespace App\Models;

class HistoryCollection
{
    private array $historyCollection = [];

    public function historyCollection(): array
    {
        return $this->historyCollection;
    }

    public function checkedIdCollection(): array
    {
        $checkedId = [];
        foreach ($this->historyCollection as $history) {
            /** @var History $history */
            $checkedId[] = $history->checkedId();
        }
        return $checkedId;
    }

    public function addHistory(History $history): void
    {
        $this->historyCollection[] = $history;
    }

    public function serialize(): array
    {
        $historyCollection = [];
        foreach ($this->historyCollection as $history) {
            /** @var History $history */
            $historyCollection[] = $history->jsonSerialize();
        }
        return $historyCollection;
    }
}