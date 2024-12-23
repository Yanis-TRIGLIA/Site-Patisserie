<?php

/**
 * Object representing an appreciation through database
 */
final class Appreciation extends DbObject {

    private static $reqManager;

    static function init() {
        self::$reqManager = new RequestsManager('APPRECIATION');
        self::$reqManager->add('select_row', 'SELECT * FROM APPRECIATION WHERE ID_APPRECIATION=?');
        self::$reqManager->add('select_by_recipe', 'SELECT * FROM APPRECIATION WHERE ID_RECIPE=?');
		self::$reqManager->add('insert_row', 'INSERT INTO APPRECIATION (ID_RECIPE, ID_AUTHOR, NAME, PUBLICATION_DATE, GRADE, COMMENTARY) VALUES (?, ?, ?, ?, ?, ?)');
		self::$reqManager->add('update_row', 'UPDATE APPRECIATION SET ID_RECIPE=?, ID_AUTHOR=?, NAME=?, PUBLICATION_DATE=?, GRADE=?, COMMENTARY=? WHERE ID_APPRECIATION=?');
		self::$reqManager->add('delete_row', 'DELETE FROM APPRECIATION WHERE ID_APPRECIATION=?');
    }

    /**
	 * Get all the existing appreciations
	 * @return array An array containing all appreciations
	 */
	public static function getAll() {
		$req_output = self::$reqManager->execute('*');
		$all_appreciations = array();
		while ($attr = $req_output->fetch())
			array_push($all_appreciations, new Appreciation($attr['ID_APPRECIATION'], $attr['ID_RECIPE'], User::getById($attr['ID_AUTHOR']), $attr['NAME'], $attr['PUBLICATION_DATE'], $attr['GRADE'], $attr['COMMENTARY']));
		return $all_appreciations;
	}

	/**
	 * Get the appreciation associated to the given id
	 * @param int $id The given id
	 * @return Appreciation The appreciation associated to the id
	 */
    public static function getById($id) {
        $attr = self::$reqManager->execute('select_row', array($id))->fetch();
        return new Appreciation($attr['ID_APPRECIATION'], $attr['ID_RECIPE'], User::getById($attr['ID_AUTHOR']), $attr['NAME'], $attr['PUBLICATION_DATE'], $attr['GRADE'], $attr['COMMENTARY']);
    }

    /**
     * Get all the appreciations matching idRecipe with the given one
     * @param mixed $idRecipe The given recipe id
     * @return array An array containing all matching appreciations
     */
    public static function getByRecipeId($idRecipe) {
        $req_output = self::$reqManager->execute('select_by_recipe', array($idRecipe));
		$appreciations = array();
        while ($appreciation = $req_output->fetch())
            array_push($appreciations, new Appreciation($appreciation['ID_APPRECIATION'], $appreciation['ID_RECIPE'], User::getById($appreciation['ID_AUTHOR']), $appreciation['NAME'], $appreciation['PUBLICATION_DATE'], $appreciation['GRADE'], $appreciation['COMMENTARY']));
		return $appreciations;
    }

    private $idRecipe;
    private $author;
    private $publicationDate;
    private $grade;
    private $commentary;

    public function __construct(?int $id, $idRecipe, $author, $name, $publicationDate, $grade, $commentary){
        parent::__construct($id, $name);
        $this->idRecipe = $idRecipe;
        $this->author = $author;
        $this-> publicationDate= $publicationDate;
        $this-> grade= $grade;
        $this->commentary = $commentary;
    }
    
    public function getIdRecipe() {
        return $this->idRecipe;
    }

    public function setIdRecipe($idRecipe) {
        $this->idRecipe = $idRecipe;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setauthor($author) {
        $this->author = $author;
    }

    public function getPublicationDate() {
        return $this->publicationDate;
    }

    public function setPublicationDate($publicationDate) {
        $this->publicationDate = $publicationDate;
    }

    public function getGrade() {
        return $this->grade;
    }

    public function setGrade($grade) {
        $this->grade = $grade;
    }

    public function getCommentary() {
        return $this->commentary;
    }

    public function setCommentary($commentary) {
        $this->commentary = $commentary;
    }

    /**
	 * Insert **this** Difficulty in the database
	 * It also set **this** id to the given auto-incremented id in database
	 * @return void
	 */
	public function insert() {
        self::$reqManager->execute('insert_row', array($this->getIdRecipe(), $this->getAuthor()->getId(), $this->getName(), $this->getPublicationDate(), $this->getGrade(), $this->getCommentary()));
		$this->setId(modele::$pdo->lastInsertId());
	}
	
	/**
	 * Put **this** Difficulty attributes in database
	 * @return void
	 */
	public function update() {
        self::$reqManager->execute('update_row', array($this->getIdRecipe(), $this->getAuthor()->getId(), $this->getName(), $this->getPublicationDate(), $this->getGrade(), $this->getCommentary(), $this->getId()));
	}
	
	/**
	 * Put database attributes in **this** Difficulty
	 * @return void
	 */
	public function refresh() {
        $row = self::$reqManager->execute('select_row', array($this->getId()))->fetch();
		$this->setName($row['NAME']);
        $this->setIdRecipe($row['ID_RECIPE']);
        $this->setAuthor(User::getById($row['ID_AUTHOR']));
        $this->setPublicationDate($row['PUBLICATION_DATE']);
        $this->setGrade($row['GRADE']);
        $this->setCommentary($row['COMMENTARY']);
	}
	
	/**
	 * Delete **this** Difficulty in the database
	 * @return void
	 */
	public function delete() {
        self::$reqManager->execute('delete_row', array($this->getId()));
	}

    public function __toString() {
        return __CLASS__ . '{' .
            'parent:' . parent::__toString() .
            ', idRecipe=' . $this->getIdRecipe() .
            ', author=' . $this->getAuthor() .
            ', publicationDate=' . $this->getPublicationDate() .
            ', grade=' . $this->getGrade() .
            ', commentary=' . $this->getCommentary() .
            '}';
    }

}

Appreciation::init();