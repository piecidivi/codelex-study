<?php

namespace App\Players;

class Player
{
    private string $type;
    private string $name;
    private string $choice;

    public function __construct(string $type, string $name)
    {
        $this->type = $type;
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function choice(): string
    {
        return $this->choice;
    }

    public function setChoice(string $choice): void
    {
        $this->choice = $choice;
    }
}