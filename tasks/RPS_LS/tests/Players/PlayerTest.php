<?php

namespace Tests\Players;

use App\Players\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testName(): void
    {
        $player = new Player("H", "You");
        $this->assertEquals("You", $player->name());
    }

    public function testType(): void
    {
        $player = new Player("H", "You");
        $this->assertEquals("H", $player->type());
    }

    public function testChoice(): void
    {
        $player = new Player("H", "You");
        $player->setChoice("Rock");
        $this->assertEquals("Rock", $player->choice());
    }
}