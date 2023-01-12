<?php

final class Recipe
{
    private $_S_message = ['ceci est une recette','ceci est une dififculté','ceci est un temps','et ceci est une note'];

    public function donneMessage()
    {
        return $this->_S_message ;
    }

}