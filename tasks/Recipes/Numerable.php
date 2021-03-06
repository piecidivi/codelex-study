<?php

// Units measured in pieces
class Numerable extends Ingredient
{
    protected int $unitWeight;

    public function setUnitWeight(int $unitWeight): void {
        $this->unitWeight = $unitWeight;
    }
}