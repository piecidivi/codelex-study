<?php

namespace App\Elements;

class Paper extends Item
{
    public function name(): string
    {
        return $this->name;
    }

    public function picture(): string
    {
        return $this->picture;
    }

    public function winner(string $opponent): bool
    {
        return $opponent === self::ITEM_ROCK;
    }
}