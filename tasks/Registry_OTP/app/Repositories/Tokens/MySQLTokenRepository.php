<?php

namespace App\Repositories\Tokens;

use App\Models\Token;
use App\Repositories\MySQLRepository;
use InvalidArgumentException;

class MySQLTokenRepository extends MySQLRepository implements TokenRepository
{
    public function createToken(Token $token): void
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $this->database->insert("Tokens", [
            "personal_code" => $token->personalCode(),
            "token" => $token->token(),
            "expiry_time" => $token->expiryTime()
        ]);

        if ($this->database->id() === null) {
            throw new InvalidArgumentException("Something went wrong. Please request another token.");
        }
    }

    public function checkToken(string $personalCode, int $expiryTime): array
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        return $this->database->select("Tokens", "*", [
            "AND" => [
                "personal_code" => "$personalCode",
                "expiry_time[>=]" => "$expiryTime"
            ],
            "LIMIT" => 1
        ]);
    }

    public function validateToken(string $token, int $expiryTime): string
    {
        if ($this->init() === "SQLSTATE[HY000] [2002] No such file or directory") {
            throw new InvalidArgumentException("No connection to database.");
        }

        $match = $this->database->select("Tokens", "personal_code", [
            "AND" => [
                "token" => "$token",
                "expiry_time[>=]" => "$expiryTime"
            ],
            "LIMIT" => 1
        ]);

        if (count($match) === 0) {
            throw new InvalidArgumentException("The token is false or expired.");
        }

        return $match[0];
    }
}