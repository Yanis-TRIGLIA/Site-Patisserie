<?php

final class ControleurRecipe
{
    public function defautAction()
    {
        $O_recipe =  new Recipe();
        Vue::montrer('recipe/mainView', array('recipe' =>  $O_recipe->donneMessage()));

    }

}