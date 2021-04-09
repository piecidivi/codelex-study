<?php

namespace App\Repositories\Tokens;

use App\Models\Token;

interface TokenRepository
{
    public function createToken(Token $token): void;

    public function checkToken(string $personalCode, int $expiryTime): array;

    public function validateToken(string $token, int $expiryTime): string;
}