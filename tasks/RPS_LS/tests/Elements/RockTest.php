<?php

namespace Tests\Elements;

use App\Elements\Rock;
use PHPUnit\Framework\TestCase;

class RockTest extends TestCase
{
    public function testName(): void
    {
        $rock = new Rock();
        $this->assertEquals("Rock", $rock->name());
    }

    public function testPicture(): void
    {
        $rock = new Rock();
        $this->assertEquals("./images/Rock.jpg", $rock->picture());
    }

    public function testWinner(): void
    {
        $rock = new Rock();
        $this->assertTrue($rock->winner("Scissors"));
    }
}