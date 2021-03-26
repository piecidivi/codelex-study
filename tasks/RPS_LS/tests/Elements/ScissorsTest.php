<?php

namespace Tests\Elements;

use App\Elements\Scissors;
use PHPUnit\Framework\TestCase;

class ScissorsTest extends TestCase
{
    public function testName(): void
    {
        $scissors = new Scissors();
        $this->assertEquals("Scissors", $scissors->name());
    }

    public function testPicture(): void
    {
        $scissors = new Scissors();
        $this->assertEquals("./images/Scissors.jpg", $scissors->picture());
    }

    public function testWinner(): void
    {
        $scissors = new Scissors();
        $this->assertTrue($scissors->winner("Paper"));
    }
}