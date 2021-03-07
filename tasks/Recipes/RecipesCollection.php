<?php


class RecipesCollection
{
    private array $recipes = [];


    public function addRecipes(array $recipes): void
    {
        foreach ($recipes as $recipe) {
            $this->addRecipe($recipe);
        }
    }

    private function addRecipe(IngredientsCollection $recipe): void
    {
        $this->recipes[] = $recipe;
    }
}