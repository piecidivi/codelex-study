<?php


class Recipe
{
    private string $name;
    private array $numerables = [];
    private array $pourables = [];

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function addNumerable(Numerable $numerable): void
    {
        $this->numerables[] = $numerable;
    }

    public function addPourable(Pourable $pourable): void {
        $this->pourables[] = $pourable;
    }

}