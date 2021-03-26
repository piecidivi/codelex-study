<?php

namespace App\Elements;

abstract class Item implements Element
{
    protected string $name;
    protected string $picture;

    const ITEM_ROCK = "Rock";
    const ITEM_PAPER = "Paper";
    const ITEM_SCISSORS = "Scissors";

    const BASE_PATH = "./images/";
    const DUMMY_PICTURE = "Figa.jpg";

    public function __construct()
    {
        $this->name = $this->getClassName();
        $this->picture = $this->assignPicture();
    }

    protected function assignPicture(): string
    {
        $path = self::BASE_PATH . $this->getClassName() . ".jpg";
        return file_exists($path) ? $path : self::BASE_PATH . self::DUMMY_PICTURE;
    }

    protected function getClassName(): string
    {
        $classVars = explode("\\", static::class);
        return array_pop($classVars);
    }
}