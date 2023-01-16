<?php

final class ControleurRecipe
{
    public function defautAction()
    {
        $O_recipe =  new Recipe();

        Vue::montrer('standard/entete', array('recipe'=> $O_recipe->donneMessage()));
        Vue::montrer('standard/navbar');
        Vue::montrer('recipe/mainInfoView', array('recipe' => $O_recipe->donneMessage1()));
        Vue::montrer('recipe/listIngredientView', array('recipe' => $O_recipe->donneMessage2()));
        Vue::montrer('recipe/listUstensileView', array('recipe' => $O_recipe->donneMessage3()));
        Vue::montrer('recipe/imageView', array('recipe' => $O_recipe->donneMessage4()));
        Vue::montrer('recipe/textView', array('recipe' => $O_recipe->donneMessage5()));
        Vue::montrer('recipe/comentaryView', array('recipe' => $O_recipe->donneMessage6()));
        Vue::montrer('standard/pied');
   }
}