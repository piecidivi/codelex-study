<?php


class IngredientsCollection
{
    private string $type;   // Recipe or basket - this could come handy when dealing with RecipesCollection
    private string $name;
    private array $numerables = [];
    private array $pourables = [];

    public function __construct(string $type, string $name) {
        $this->type = $type;
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getNumerables(): array {
        return $this->numerables;
    }

    public function getPourables(): array {
        return $this->pourables;
    }

    public function addIngredient(object $object): void {
        if (get_class($object) === "Numerable") {
            $this->numerables[] = $object;
        }
        if (get_class($object) === "Pourable") {
            $this->pourables[] = $object;
        }
    }

}