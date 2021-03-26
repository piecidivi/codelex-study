<?php

namespace App\Players;

class PlayerCollection
{
    private array $players = [];

    public function __construct(array $players)
    {
        $this->addPlayers($players);
    }

    public function players(): array
    {
        return $this->players;
    }

    private function addPlayers(array $players): void
    {
        foreach ($players as $player) {
            $this->add($player);
        }
    }

    private function add(Player $player): void
    {
        $this->players[] = $player;
    }
}