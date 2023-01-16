<?php

final class Recipe{

    private static $sql1 = 'SELECT NAME,DESCRIPTION,DURATION,ID_AUTHOR,ID_DIFFICULTY,ID_COST FROM RECIPE WHERE ID_RECIPE=?';
    private static $sql2 = 'SELECT ID_USTENSIL FROM RECIPE_USTENSIL WHERE ID_RECIPE=?';

    private static $req_prep1;
    private static $req_prep2;

    public static function getById($id) {
        if (is_null(self::$req_prep1))
            self::$req_prep1 = modele::$pdo->prepare(self::$sql1);
        if (is_null(self::$req_prep2))
            self::$req_prep2 = modele::$pdo->prepare(self::$sql2);
        self::$req_prep1->execute(array($id));
        $row = self::$req_prep1->fetch();
        self::$req_prep2->execute(array($id));
        $ustensils = array();
        while ($idUstensil = self::$req_prep2->fetch())
            array_push($ustensils, Ustensil::getById($idUstensil['ID_USTENSIL']));
        return new Recipe($id, $row['NAME'],$row ['DESCRIPTION'], $row['DURATION'], User::getById($row['ID_AUTHOR']), Difficulty::getById($row['ID_DIFFICULTY']), Cost::getById($row['ID_COST']), $ustensils);
    }

    private $id;
    private $name;
    private $description;
    private $duration;
    private $author;
    private $difficulty;
    private $cost;
    private $ustensils;

    private function __construct($id, $name, $description, $duration, $author, $difficulty, $cost, $ustensils){
        $this-> id = $id;
        $this->name = $name;
        $this-> description= $description;
        $this-> duration= $duration;
        $this->author = $author;
        $this->difficulty = $difficulty;
        $this->cost = $cost;
        $this->ustensils = $ustensils;
    }
    
    public function getId(){
        return $this->id;              
    }

    public function getName(){
        return $this->name;              
    }

    public function getDescription(){
        return $this->description;
    }

    public function getDuration(){
        return $this->duration;
    }

    public function getAuthor(){
        return $this->author;              
    }

    public function getDifficulty(){
        return $this->difficulty;              
    }

    public function getCost(){
        return $this->cost;              
    }

    public function getUstencils(){
        return $this->ustensils;             
    }

    public function __toString() {
        return "Recipe{id=" . $this->getId() . ", name=" . $this->getName() . ", description=" . $this->getDescription() . ", duration=" . $this->getDuration() . ", author=" . $this->getAuthor() . ", difficulty=" . $this->getDifficulty() . ", cost=" . $this->getCost() . ", ustensils=" . implode($this->getUstencils()) . "}";
    }

}