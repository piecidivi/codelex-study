<?php

namespace Tests\Players;

use App\Players\Player;
use App\Players\PlayerCollection;
use PHPUnit\Framework\TestCase;

class PlayerCollectionTest extends TestCase
{
    public function testPlayers(): void
    {
        $players = new PlayerCollection([new Player("H", "You"), new Player("C", "Computer")]);
        $this->assertIsArray($players->players());
        $this->assertCount(2, $players->players());
        $this->assertInstanceOf(Player::class, $players->players()[0]);
    }
}