<?php


class IngredientsCollection
{
    private string $type;   // Recipe or basket
    private string $name;
    private array $numerables = [];
    private array $pourables = [];

    public function __construct(string $type, string $name)
    {
        $this->type = $type;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getNumerables(): array
    {
        return $this->numerables;
    }

    public function getPourables(): array
    {
        return $this->pourables;
    }

    public function addIngredient(object $object): void
    {
        if (get_class($object) === "Numerable") {
            $this->numerables[] = $object;
        }
        if (get_class($object) === "Pourable") {
            $this->pourables[] = $object;
        }
    }

    public static function checkBasket(IngredientsCollection $recipe, IngredientsCollection $basket, Dictionary $dictionary): bool
    {
        $variable = 0;
        foreach ($recipe->getNumerables() as $recipeIngredient) {
            foreach ($basket->getNumerables() as $basketIngredient) {
                /** @var Numerable $recipeIngredient */
                /** @var Numerable $basketIngredient */
                if ($recipeIngredient->getName() === $basketIngredient->getName() &&
                    Numerable::compareItems($recipeIngredient, $basketIngredient)) {
                    $variable++;
                }
            }
        }
        foreach ($recipe->getPourables() as $recipeIngredient) {
            foreach ($basket->getPourables() as $basketIngredient) {
                /** @var Pourable $recipeIngredient */
                /** @var Pourable $basketIngredient */
                if ($recipeIngredient->getName() === $basketIngredient->getName() &&
                    Pourable::compareItems($recipeIngredient, $basketIngredient, $dictionary)) {
                    $variable++;
                }
            }
        }
        return $variable === count($recipe->getNumerables()) + count($recipe->getPourables());
    }
}