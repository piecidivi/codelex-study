<?php

namespace Tests\Models;

use App\Models\Token;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    public function testPersonalCode(): void
    {
        $token = new Token("12345678901", "123", 200);
        $this->assertEquals("12345678901", $token->personalCode());
    }

    public function testToken(): void
    {
        $token = new Token("12345678901", "123", 200);
        $this->assertEquals("123", $token->token());
    }

    public function testExpiryTime(): void
    {
        $token = new Token("12345678901", "123", 200);
        $this->assertEquals(200, $token->expiryTime());
    }

    public function testUrl(): void
    {
        $token = new Token("12345678901", "123", 200);
        $this->assertEquals("localhost:8080/login?token=123", $token->url());
    }
}