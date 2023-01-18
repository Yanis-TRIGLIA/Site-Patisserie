<?php

final class ControleurRecipe
{
    public function defautAction()
    {
        echo strval(User::getById(1));
        echo '<br>';
        echo strval(Recipe::getById(1));
    }
   
}