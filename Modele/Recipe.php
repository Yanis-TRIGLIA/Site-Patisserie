<?php

final class Recipe
{
    private $_S_message = ['ceci est une recette','ceci est une dififculté','ceci est un temps','et ceci est une note'];
    private $_S_message2 = ['image/galette_des_rois.jpeg','ceci est une galette des roi'];

    public function donneMessage()
    {
        return $this->_S_message ;
    }

    public function donneMessage2()
    {
        return $this->_S_message2 ;
    }
}