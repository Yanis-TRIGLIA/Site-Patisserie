<?php

final class Recipe{

    private static $sql = 'SELECT NAME,DESCRIPTION,DURATION,ID_AUTHOR,ID_DIFFICULTY,ID_COST FROM RECIPE WHERE ID_RECIPE=?';
    private static $req_prep;

    public static function getById($id){
        if (is_null(self::$req_prep))
            self::$req_prep = modele::$pdo->prepare(self::$sql);
        self::$req_prep->execute(array($id));
        $row = self::$req_prep->fetch();
        return new Recipe($id, $row['NAME'],$row ['DESCRIPTION'], $row['DURATION'], User::getById($row['ID_AUTHOR']), Difficulty::getById($row['ID_DIFFICULTY']), Cost::getById($row['ID_COST']));
    }

    private $id;
    private $name;
    private $description;
    private $duration;
    private $author;
    private $difficulty;
    private $cost;

    private function __construct($id, $name, $description, $duration, $author, $difficulty, $cost){
        $this-> id = $id;
        $this->name = $name;
        $this-> description= $description;
        $this-> duration= $duration;
        $this->author = $author;
        $this->difficulty = $difficulty;
        $this->cost = $cost;
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

    public function __toString() {
        return "Recipe{id=" . $this->getId() . ", name=" . $this->getName() . ", description=" . $this->getDescription() . ", duration=" . $this->getDuration() . ", author=" . $this->getAuthor() . ", difficulty=" . $this->getDifficulty() . ", cost=" . $this->getCost() . "}";
    }

}