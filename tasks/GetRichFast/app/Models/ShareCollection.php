<?php

namespace App\Models;

class ShareCollection
{
    private array $shares = [];

    public function shares(): array
    {
        return $this->shares;
    }

    public function addShare(Share $share): void
    {
        $this->shares[] = $share;
    }

    public function serialize(): array
    {
        $shares = [];
        foreach ($this->shares as $share) {
            /** @var Share $share */
            $shares[] = $share->jsonSerialize();
        }
        return $shares;
    }
}