<?php

namespace Tests\Elements;

use App\Elements\ElementCollection;
use App\Elements\Paper;
use App\Elements\Rock;
use App\Elements\Scissors;
use PHPUnit\Framework\TestCase;

class ElementCollectionTest extends TestCase
{
    public function testElements(): void
    {
        $elements = new ElementCollection([new Rock, new Paper, new Scissors]);
        $this->assertIsArray($elements->elements());
        $this->assertCount(3, $elements->elements());
        $this->assertInstanceOf(Rock::class, $elements->elements()[0]);
        $this->assertInstanceOf(Paper::class, $elements->elements()[1]);
        $this->assertInstanceOf(Scissors::class, $elements->elements()[2]);
    }

    public function testGetElementByName(): void
    {
        $elements = new ElementCollection([new Rock, new Paper, new Scissors]);
        $this->assertInstanceOf(Rock::class, $elements->getElementByName("Rock"));
    }
}