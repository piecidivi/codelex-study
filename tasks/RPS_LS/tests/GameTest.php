<?php

namespace Tests;

use App\Elements\ElementCollection;
use App\Elements\Paper;
use App\Elements\Rock;
use App\Elements\Scissors;
use App\Game;
use App\Players\Player;
use App\Players\PlayerCollection;

class GameTest extends \PHPUnit\Framework\TestCase
{
    public function testSetChoice(): void
    {
        $elements = new ElementCollection([new Rock]);
        $human = new Player("H", "You");
        $computer = new Player("C", "Computer");
        $players = new PlayerCollection([$human, $computer]);
        $game = new Game($elements, $players);

        $game->setChoice("Rock");
        $this->assertEquals("Rock", $human->choice());
        $this->assertEquals("Rock", $computer->choice());
    }

    public function testTieGameResult(): void
    {
        $elements = new ElementCollection([new Rock, new Paper, new Scissors]);
        $player1 = new Player("H", "Player1");
        $player2 = new Player("H", "Player2");
        $players = new PlayerCollection([$player1, $player2]);
        $game = new Game($elements, $players);

        $player1->setChoice("Rock");
        $player2->setChoice("Rock");
        $this->assertEquals("Game is a tie!", $game->gameResult($player1, $player2));
    }

    public function testWinGameResult(): void
    {
        $elements = new ElementCollection([new Rock, new Paper, new Scissors]);
        $player1 = new Player("H", "Player1");
        $player2 = new Player("H", "Player2");
        $players = new PlayerCollection([$player1, $player2]);
        $game = new Game($elements, $players);

        $player1->setChoice("Rock");
        $player2->setChoice("Scissors");
        $this->assertEquals("Player1 won!", $game->gameResult($player1, $player2));
    }
}