<?php

/**
 * Object representing a recipe through database
 */
final class Recipe extends DbObject {


    private static $sql1 = 'SELECT NAME,DESCRIPTION,DURATION,ID_AUTHOR,ID_DIFFICULTY,ID_COST, IMAGE_URL FROM RECIPE WHERE ID_RECIPE=?';
    private static $sql2 = 'SELECT ID_USTENSIL FROM RECIPE_USTENSIL WHERE ID_RECIPE=?';
    private static $sql3 = 'SELECT ID_INGREDIENT, QUANTITY FROM RECIPE_INGREDIENT WHERE ID_RECIPE=?';
    private static $sql4 = 'SELECT ID_APPRECIATION FROM APPRECIATION WHERE ID_RECIPE=?';
    private static $sql5 = 'INSERT INTO RECIPE (NAME, DESCRIPTION, DURATION, ID_AUTHOR, ID_DIFFICULTY, ID_COST, IMAGE_URL) VALUES (?, ?, ?, ?, ?, ?, ?)';
    private static $sql6 = 'INSERT INTO RECIPE_USTENSIL (ID_RECIPE, ID_USTENSIL) VALUES (?, ?)';
    private static $sql7 = 'INSERT INTO RECIPE_INGREDIENT (ID_RECIPE, ID_INGREDIENT) VALUES (?, ?)';

    private static $req_prep1;
    private static $req_prep2;
    private static $req_prep3;
    private static $req_prep4;
    private static $req_prep5;
    private static $req_prep6;
    private static $req_prep7;

    static function prepare() {
        self::$req_prep1 = modele::$pdo->prepare(self::$sql1);
        self::$req_prep2 = modele::$pdo->prepare(self::$sql2);
        self::$req_prep3 = modele::$pdo->prepare(self::$sql3);
        self::$req_prep4 = modele::$pdo->prepare(self::$sql4);
        self::$req_prep5 = modele::$pdo->prepare(self::$sql5);
        self::$req_prep6 = modele::$pdo->prepare(self::$sql6);
        self::$req_prep7 = modele::$pdo->prepare(self::$sql7);
    }
    

    public static function getById($id) {
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
        return new Recipe($id, $row['NAME'],explode('\n', $row['DESCRIPTION']), $row['DURATION'], User::getById($row['ID_AUTHOR']), Difficulty::getById($row['ID_DIFFICULTY']), Cost::getById($row['ID_COST']), $ustensils, $ingredients, $appreciations, $row['IMAGE_URL']);
    }

    public static function createRecipe($name, $description, $duration, $author, $difficulty, $cost, $ustensils, $ingredients, $imageUrl) {
        self::$req_prep5->execute(array($name, $description, $duration, $author, $difficulty->getId(), $cost->getId(), $imageUrl));
        // TODO put ustensils and ingredients (after reformated all objects stucture)
    }

    private $description;
    private $duration;
    private $author;
    private $difficulty;
    private $cost;
    private $ustensils;
    private $ingredients;
    private $appreciations;
    private $imageUrl;

    private function __construct(
        $id, $name, $description, $duration, $author, $difficulty, $cost,
        $ustensils, $ingredients, $appreciations, $imageUrl
    ) {
        parent::__construct($id, $name);
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

    public function getUstensils(){
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

    /**
	 * Insert **this** Recipe in the database
	 * It also set **this** id to the given auto-incremented id in database
	 * @return void
	 */
	public function insert() {
	}
	
	/**
	 * Put **this** Recipe attributes in database
	 * @return void
	 */
	public function update() {
	}
	
	/**
	 * Put database attributes in **this** Recipe
	 * @return void
	 */
	public function refresh() {
	}
	
	/**
	 * Delete **this** Recipe in the database
	 * @return void
	 */
	public function delete() {
	}

    public function __toString() {
        return __CLASS__ . '{' .
            'parent:' . parent::__toString() .
            ', description=' . implode($this->getDescription()) .
            ', duration=' . $this->getDuration() .
            ', author=' . $this->getAuthor() .
            ', difficulty=' . $this->getDifficulty() .
            ', cost=' . $this->getCost() .
            ', ustensils=' . implode($this->getUstensils()) .
            ', ingredient=' .implode($this->getIngredients()) .
            ', appreciations=' . implode($this->getAppreciations()) .
            ', imageUrl=' . $this->getImageUrl() .
            '}';
    }

}

Recipe::prepare();