<?php


final class Recipe{


    private static $sql1 = 'SELECT NAME,DESCRIPTION,DURATION,ID_AUTHOR,ID_DIFFICULTY,ID_COST, IMAGE_URL FROM RECIPE WHERE ID_RECIPE=?';
    private static $sql2 = 'SELECT ID_USTENSIL FROM RECIPE_USTENSIL WHERE ID_RECIPE=?';
    private static $sql3 = 'SELECT ID_INGREDIENT FROM RECIPE_INGREDIENT WHERE ID_RECIPE=?';
    private static $sql4 = 'SELECT ID_APPRECIATION FROM APPRECIATION WHERE ID_RECIPE=?';

    private static $req_prep1;
    private static $req_prep2;
    private static $req_prep3;
    private static $req_prep4;

    public static function getById($id) {
        if (is_null(self::$req_prep1))
            self::$req_prep1 = modele::$pdo->prepare(self::$sql1);
        if (is_null(self::$req_prep2))
            self::$req_prep2 = modele::$pdo->prepare(self::$sql2);
        if (is_null(self::$req_prep3))
            self::$req_prep3 = modele::$pdo->prepare(self::$sql3);
        if (is_null(self::$req_prep4))
            self::$req_prep4 = modele::$pdo->prepare(self::$sql4);
        self::$req_prep1->execute(array($id));
        $row = self::$req_prep1->fetch();
        self::$req_prep2->execute(array($id));
        $ustensils = array();
        while ($idUstensil = self::$req_prep2->fetch())
            array_push($ustensils, Ustensil::getById($idUstensil['ID_USTENSIL']));
        self::$req_prep3->execute(array($id));
        $ingredients = array();
        while ($idIngredient = self::$req_prep3->fetch())
            array_push($ingredients, Ingredient::getById($idIngredient['ID_INGREDIENT']));
        self::$req_prep4->execute(array($id));
        $appreciations = array();
        while ($idAppreciation = self::$req_prep4->fetch())
            array_push($appreciations, Appreciation::getById($idAppreciation['ID_APPRECIATION']));
        return new Recipe($id, $row['NAME'],$row ['DESCRIPTION'], $row['DURATION'], User::getById($row['ID_AUTHOR']), Difficulty::getById($row['ID_DIFFICULTY']), Cost::getById($row['ID_COST']), $ustensils, $ingredients, $appreciations, $row['IMAGE_URL']);
    }

    private $id;
    private $name;
    private $description;
    private $duration;
    private $author;
    private $difficulty;
    private $cost;
    private $ustensils;
    private $ingredients;
    private $appreciations;
    private $imageUrl;

    private function __construct($id, $name, $description, $duration, $author, $difficulty, $cost, $ustensils,$ingredients, $appreciations, $imageUrl){
        $this-> id = $id;
        $this->name = $name;
        $this-> description= $description;
        $this-> duration= $duration;
        $this->author = $author;
        $this->difficulty = $difficulty;
        $this->cost = $cost;
        $this->ustensils = $ustensils;
        $this->ingredients = $ingredients;
        $this->appreciations = $appreciations;
        $this->imageUrl = $imageUrl;
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

    public function getIngredients(){
        return $this->ingredients;             
    }

    public function getAppreciations(){
        return $this->appreciations;
    }

    public function getImageUrl() {
        return $this->imageUrl;
    }

    public function __toString() {
        return "Recipe{id=" . $this->getId() . ", name=" . $this->getName() . ", description=" . $this->getDescription() . ", duration=" . $this->getDuration() . ", author=" . $this->getAuthor() . ", difficulty=" . $this->getDifficulty() . ", cost=" . $this->getCost() . ", ustensils=" . implode($this->getUstencils()) .", ingredient=" .implode($this->getIngredients()) . ", appreciations=" . implode($this->getAppreciations()) . ", imageUrl=" . $this->getImageUrl() . "}";
    }


}