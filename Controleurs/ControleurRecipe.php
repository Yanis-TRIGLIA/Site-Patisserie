<?php

final class ControleurRecipe
{
    public function defautAction()
    {
        $O_recipe =  new Recipe();
        Vue::montrer('recipe/mainInfoView', array('recipe' => $O_recipe->donneMessage()));
        Vue::montrer('recipe/listView', array('recipe' => $O_recipe->donneMessage()));
        Vue::montrer('recipe/listView', array('recipe' => $O_recipe->donneMessage()));
        Vue::montrer('recipe/imageView', array('recipe' => $O_recipe->donneMessage2()));
        Vue::montrer('recipe/textView', array('recipe' => $O_recipe->donnemessage()));
        Vue::montrer('recipe/imageView', array('recipe' => $O_recipe->donneMessage2()));
    }

}