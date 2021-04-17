<?php

namespace Tests\Models;

use App\Models\Share;
use PHPUnit\Framework\TestCase;

class ShareTest extends TestCase
{
    public function testId(): void
    {
        $share = new Share("AAPL", 10, 125, 1);
        $this->assertEquals(1, $share->id());
    }

    public function testSymbol(): void
    {
        $share = new Share("AAPL", 10, 125, 1);
        $this->assertEquals("AAPL", $share->symbol());
    }

    public function testAmount(): void
    {
        $share = new Share("AAPL", 10, 125, 1);
        $this->assertEquals(10, $share->amount());
    }

    public function testPriceOne(): void
    {
        $share = new Share("AAPL", 10, 125, 1);
        $this->assertEquals(125, $share->priceOne());
    }

    public function testPriceTotal(): void
    {
        $share = new Share("AAPL", 10, 125, 1);
        $this->assertEquals(1250, $share->priceTotal());
    }

    public function testPurchaseDate(): void
    {
        $share = new Share("AAPL", 10, 125, 1);
        $this->assertEquals("0", $share->purchaseDate());
    }

    public function testProfitState(): void
    {
        $share = new Share("AAPL", 10, 125, 1);
        $this->assertEquals("gray", $share->profitState());
    }

    public function testStatus(): void
    {
        $share = new Share("AAPL", 10, 125, 1);
        $this->assertEquals("open", $share->status());
    }

    public function testSetQuote(): void
    {
        $share = new Share("AAPL", 10, 125, 1);
        $share->setQuote(1.30);

        $this->assertEquals(130, $share->quote());
        $this->assertEquals(50, $share->project());
        $this->assertEquals("green", $share->profitState());
    }

    public function testBuy(): void
    {
        $share = new Share("AAPL", 10, 125, 1);
        $share->buy(10);

        $this->assertEquals(20, $share->amount());
        $this->assertEquals("open", $share->status());
    }

    public function testSell(): void
    {
        $share = new Share("AAPL", 10, 125, 1);
        $share->sell();

        $this->assertEquals(0, $share->amount());
        $this->assertEquals("closed", $share->status());
    }
}