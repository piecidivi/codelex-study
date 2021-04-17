<?php

namespace App\Repositories\Shares;

use App\Models\Share;
use App\Models\ShareCollection;

interface ShareRepository
{
    public function addShare(Share $share): int;

    public function getShares(): ShareCollection;

    public function getById(int $shareId): Share;

    public function updateShares(ShareCollection $shares): void;

    public function updateOneShare(Share $share): void;
}