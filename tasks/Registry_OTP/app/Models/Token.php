<?php

namespace App\Models;

class Token
{
    private int $id;
    private string $personalCode;
    private ?string $token;
    private ?int $expiryTime;
    private string $url;

    const TOKEN_TIME_SECONDS = 900;
    const URL_PREFIX = "localhost:8080/login?token=";

    public function __construct(string $personalCode, ?string $token = null, ?int $expiryTime = null)
    {
        $this->personalCode = $personalCode;
        if ($token && $expiryTime) $this->makeExistingTokenObject($token, $expiryTime);
        else $this->makeNewTokenObject();
    }

    public function personalCode(): string
    {
        return $this->personalCode;
    }

    public function token(): string
    {
        return $this->token;
    }

    public function expiryTime(): int
    {
        return $this->expiryTime;
    }

    public function url(): string
    {
        return $this->url;
    }

    private function makeExistingTokenObject(string $token, int $expiryTime): void
    {
        $this->token = $token;
        $this->expiryTime = $expiryTime;
        $this->setUrl();
    }

    private function makeNewTokenObject(): void
    {
        $this->expiryTime = mktime() + self::TOKEN_TIME_SECONDS;
        $this->setToken();
        $this->setUrl();
    }

    private function setToken(): void
    {
        $this->token = $this->personalCode . strval($this->expiryTime);
    }

    private function setUrl(): void
    {
        $this->url = self::URL_PREFIX . $this->token;
    }
}