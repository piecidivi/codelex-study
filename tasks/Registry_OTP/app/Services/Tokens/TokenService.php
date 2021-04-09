<?php

namespace App\Services\Tokens;

use App\Models\Token;
use App\Models\Person;
use App\Repositories\Persons\PersonRepository;
use App\Repositories\Tokens\TokenRepository;

class TokenService
{
    private PersonRepository $personsRepository;
    private TokenRepository $tokenRepository;

    public function __construct(PersonRepository $personsRepository, TokenRepository $tokenRepository)
    {
        $this->personsRepository = $personsRepository;
        $this->tokenRepository = $tokenRepository;
    }

    public function createToken(string $personalCode, int $time): string
    {
        $checkToken = $this->tokenRepository->checkToken($personalCode, $time);
        if (count($checkToken) === 1) {
            $token = new Token($checkToken[0]["personal_code"], $checkToken[0]["token"], $checkToken[0]["expiry_time"]);
            return $token->url();
        }

        $token = new Token($this->personsRepository->getById($personalCode)->personalCode());
        $this->tokenRepository->createToken($token);
        return $token->url();
    }

    public function validateToken(string $token, int $expiryTime): Person
    {
        $personalCode = $this->tokenRepository->validateToken($token, $expiryTime);
        return $this->personsRepository->getById($personalCode);
    }
}