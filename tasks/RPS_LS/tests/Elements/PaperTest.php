<?php

namespace Tests\Elements;

use App\Elements\Paper;
use PHPUnit\Framework\TestCase;

class PaperTest extends TestCase
{
    public function testName(): void
    {
        $paper = new Paper();
        $this->assertEquals("Paper", $paper->name());
    }

    public function testPicture(): void
    {
        $paper = new Paper();
        $this->assertEquals("./images/Paper.jpg", $paper->picture());
    }

    public function testWinner(): void
    {
        $paper = new Paper();
        $this->assertTrue($paper->winner("Rock"));
    }
}