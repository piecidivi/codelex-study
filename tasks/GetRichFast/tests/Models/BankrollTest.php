<?php

namespace Tests\Models;

use App\Models\Bankroll;
use PHPUnit\Framework\TestCase;

class BankrollTest extends TestCase
{
    public function testId(): void
    {
        $bankroll = new Bankroll(1, "My Bankroll", 1000);
        $this->assertEquals(1, $bankroll->id());
    }

    public function testName(): void
    {
        $bankroll = new Bankroll(1, "My Bankroll", 1000);
        $this->assertEquals("My Bankroll", $bankroll->name());
    }

    public function testBankroll(): void
    {
        $bankroll = new Bankroll(1, "My Bankroll", 1000);
        $this->assertEquals(1000, $bankroll->bankroll());
    }

    public function testBuyFail(): void
    {
        $this->expectExceptionMessage("Not enough money for trade.");

        $bankroll = new Bankroll(1, "My Bankroll", 1000);
        $bankroll->buy(500, 4);
    }

    public function testBuySuccess(): void
    {
        $bankroll = new Bankroll(1, "My Bankroll", 1000);
        $bankroll->buy(125, 2);

        $this->assertEquals(750, $bankroll->bankroll());
    }

    public function testSell(): void
    {
        $bankroll = new Bankroll(1, "My Bankroll", 1000);
        $bankroll->sell(125, 2);

        $this->assertEquals(1250, $bankroll->bankroll());
    }
}