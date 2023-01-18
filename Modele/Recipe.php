<?php

final class Recipe
{
    private $_S_message = 'ceci est le titre de la recette';
    private $_S_message1 = ['ceci est le titre de la recette','ceci est une dififculté','ceci est un temps','et ceci est une note'];
    private $_S_message2 = ["ceci est l'ingrédient 1","ceci est l'ingrédient 2","ceci est l'ingrédient 3"];
    private $_S_message3 = ["ceci est l'ustensile 1","ceci est l'ustensile 2","ceci est l'ustensile 3"];
    private $_S_message4 = ['/image/galette_des_rois.jpeg','ceci est une galette des roi'];
    private $_S_message5 = ['ceci est le texte qui explique comment faire la recette',"ceci est le nom de l'auteur",'ceci est le coût de la recette'];
    private $_S_message6 = ['ceci est un commentaire','ceci est une note'];

    public function donneMessage()
    {
        return $this->_S_message ;
    }

    public function donneMessage1()
    {
        return $this->_S_message1 ;
    }

    public function donneMessage2()
    {
        return $this->_S_message2 ;
    }

    public function donneMessage3()
    {
        return $this->_S_message3 ;
    }

    public function donneMessage4()
    {
        return $this->_S_message4 ;
    }

    public function donneMessage5()
    {
        return $this->_S_message5 ;
    }
    public function donneMessage6()
    {
        return $this->_S_message6 ;
    }
}