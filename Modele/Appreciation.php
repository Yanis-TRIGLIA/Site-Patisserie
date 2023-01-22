<?php

final class Appreciation extends DbObject {

    private static $sql1 = 'SELECT ID_RECIPE,ID_AUTHOR,NAME,DATE_FORMAT(PUBLICATION_DATE , "%d %b %Y") AS PUBLICATION_DATE ,GRADE,COMMENTARY FROM APPRECIATION WHERE ID_APPRECIATION=?';
    private static $sql2 = 'INSERT INTO APPRECIATION (ID_RECIPE, ID_AUTHOR, NAME, PUBLICATION_DATE, GRADE, COMMENTARY) VALUES (?, ?, ?, ?, ?)';
    private static $req_prep1;
    private static $req_prep2;

    static function prepare() {
        self::$req_prep1 = modele::$pdo->prepare(self::$sql1);
        self::$req_prep2 = modele::$pdo->prepare(self::$sql2);
    }

    public static function getById($id) {
        self::$req_prep1->execute(array($id));
        $row = self::$req_prep1->fetch();
        return new Appreciation($id,$row['ID_RECIPE'],User::getById($row['ID_AUTHOR']),$row['NAME'],$row['PUBLICATION_DATE'],$row['GRADE'],$row['COMMENTARY']);
    }

    public static function createAppreciation($recipe, $author, $name, $publicationDate, $grade, $commentary) {
        self::$req_prep2->execute(array($recipe->getId(), $author->getId(), $name, $publicationDate, $grade, $commentary));
    }

    private $idRecipe;
    private $author;
    private $publicationDate;
    private $grade;
    private $commentary;

    private function __construct($id, $idRecipe, $author, $name, $publicationDate, $grade, $commentary){
        parent::__construct($id, $name);
        $this->idRecipe = $idRecipe;
        $this->author = $author;
        $this-> publicationDate= $publicationDate;
        $this-> grade= $grade;
        $this->commentary = $commentary;
    }
    
    public function getIdRecipe(){
        return $this->idRecipe;
    }
    public function getAuthor(){
        return $this->author;              
    }

    public function getDate(){
        return $this->publicationDate;
    }

    public function getGrade(){
        return $this->grade;
    }

    public function getCommentary(){
        return $this->commentary;              
    }

    /**
	 * Insert **this** Difficulty in the database
	 * It also set **this** id to the given auto-incremented id in database
	 * @return void
	 */
	public function insert() {
	}
	
	/**
	 * Put **this** Difficulty attributes in database
	 * @return void
	 */
	public function update() {
	}
	
	/**
	 * Put database attributes in **this** Difficulty
	 * @return void
	 */
	public function refresh() {
	}
	
	/**
	 * Delete **this** Difficulty in the database
	 * @return void
	 */
	public function delete() {
	}

    public function __toString() {
        return __CLASS__ . '{' .
            'parent:' . parent::__toString() .
            ', id=' . $this->getId() .
            ', recipe=' . $this->getIdRecipe() .
            ', author=' . $this->getAuthor() .
            ', name=' . $this->getName() .
            ', date=' . $this->getDate() .
            ', grade=' . $this->getGrade() .
            ', commentary=' . $this->getCommentary() .
            '}';
    }

}

Appreciation::prepare();