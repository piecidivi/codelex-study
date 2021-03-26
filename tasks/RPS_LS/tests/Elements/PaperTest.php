<?php


use App\Elements\Paper;
use PHPUnit\Framework\TestCase;

class PaperTest extends TestCase
{
    public function testName(): void
    {
        $paper = new Paper();
        $this->assertEquals("Paper", $paper->name());
    }

    public function testIcon(): void
    {
        $paper = new Paper();
        $this->assertEquals("&#9744", $paper->icon());
    }

    public function testWinner(): void
    {
        $paper = new Paper();
        $this->assertTrue($paper->winner("Rock"));
    }
}