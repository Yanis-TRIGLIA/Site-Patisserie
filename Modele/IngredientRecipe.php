<?php

final class IngredientRecipe {

    private $ingredient;
    private $quantity;

    public function __construct($ingredient, $quantity) {
        $this->ingredient = $ingredient;
        $this->quantity = $quantity;
    }

    public function getIngredient() {
        return $this->ingredient;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function __toString() {
        return __CLASS__ . '{' .
            'ingredient=' . $this->getIngredient() .
            ', quantity=' . $this->getQuantity();
    }

}