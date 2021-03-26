<?php

namespace App;

use App\Elements\Element;
use App\Elements\ElementCollection;
use App\Players\Player;
use App\Players\PlayerCollection;

class Game
{
    private ElementCollection $elements;
    private PlayerCollection $players;

    public function __construct(ElementCollection $elements, PlayerCollection $players)
    {
        $this->elements = $elements;
        $this->players = $players;
    }

    public function setChoice(string $choice): void
    {
        foreach ($this->players->players() as $player) {
            /** @var Player $player */
            if ($player->type() === "H") {
                $player->setChoice($choice);
            }
            if ($player->type() === "C") {
                $player->setChoice($this->chooseRandom());
            }
        }
    }

    private function chooseRandom(): string
    {
        /** @var Element $element */
        $element = $this->elements->elements()[array_rand($this->elements->elements())];
        return $element->name();
    }

    public function gameResult(Player $player1, Player $player2): string
    {

        if ($player1->choice() === $player2->choice()) {
            return "Game is a tie!";
        }

        return $this->chooseWinner($player1, $player2) . " won!";
    }

    private function chooseWinner(Player $player1, Player $player2): string
    {
        return $this->elements->getElementByName($player1->choice())->winner($player2->choice()) ?
            $player1->name() : $player2->name();
    }
}