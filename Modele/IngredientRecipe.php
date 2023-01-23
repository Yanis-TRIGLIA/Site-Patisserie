<?php

final class IngredientRecipe {

    private $recipe;
    private $ingredient;
    private $quantity;

    public function __construct($recipe, $ingredient, $quantity) {
        $this->recipe = $recipe;
        $this->ingredient = $ingredient;
        $this->quantity = $quantity;
    }

    public function getRecipe() {
        return $this->recipe;
    }

    public function getIngredient() {
        return $this->ingredient;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function __toString() {
        return __CLASS__ . '{' .
            'recipe=' . $this->getRecipe()->getId() .
            ', ingredient=' . $this->getIngredient() .
            ', quantity=' . $this->getQuantity();
    }

}