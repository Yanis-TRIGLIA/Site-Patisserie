<?php

/**
 * Object representing an ingredient through database
 */
final class Ingredient extends DbObject {

    private static $reqManager;

    static function init() {
        self::$reqManager = new RequestsManager('INGREDIENT');
        self::$reqManager->add('select_row', 'SELECT * FROM INGREDIENT WHERE ID_INGREDIENT=?');
		self::$reqManager->add('insert_row', 'INSERT INTO INGREDIENT (NAME, UNIT) VALUES (?, ?)');
		self::$reqManager->add('update_row', 'UPDATE INGREDIENT SET NAME=?, UNIT=? WHERE ID_INGREDIENT=?');
		self::$reqManager->add('delete_row', 'DELETE FROM INGREDIENT WHERE ID_INGREDIENT=?');
    }

    /**
	 * Get all the existing ingredients
	 * @return array An array containing all ingredients
	 */
	public static function getAll() {
		$req_output = self::$reqManager->execute('*');
		$all_ingredients = array();
		while ($attr = $req_output->fetch())
			array_push($all_ingredients, new Ingredient($attr['ID_INGREDIENT'], $attr['NAME'], $attr['UNIT']));
		return $all_ingredients;
	}

	/**
	 * Get the ingredient associated to the given id
	 * @param int $id The given id
	 * @return Ingredient The ingredient associated to the id
	 */
    public static function getById($id) {
        $attr = self::$reqManager->execute('select_row', array($id))->fetch();
        return new Ingredient($attr['ID_INGREDIENT'], $attr['NAME'], $attr['UNIT']);
    }

    private $unit;

    public function __construct(?int $id, $name, $unit){
        parent::__construct($id, $name);
        $this->unit = $unit;
    }

    public function getUnit() {
        return $this->unit;
    }

    public function setUnit($unit) {
        $this->unit = $unit;
    }

	/**
	 * Insert **this** Ingredient in the database
	 * It also set **this** id to the given auto-incremented id in database
	 * @return void
	 */
	public function insert() {
        self::$reqManager->execute('insert_row', array($this->getName(), $this->getUnit()));
		$this->setId(modele::$pdo->lastInsertId());
	}
	
	/**
	 * Put **this** Ingredient attributes in database
	 * @return void
	 */
	public function update() {
        self::$reqManager->execute('update_row', array($this->getName(), $this->getUnit(), $this->getId()));
	}
	
	/**
	 * Put database attributes in **this** Ingredient
	 * @return void
	 */
	public function refresh() {
        $row = self::$reqManager->execute('select_row', array($this->getId()))->fetch();
		$this->setName($row['NAME']);
        $this->setUnit($row['UNIT']);
	}
	
	/**
	 * Delete **this** Ingredient in the database
	 * @return void
	 */
	public function delete() {
        self::$reqManager->execute('delete_row', array($this->getId()));
	}

    public function __toString() {
        return __CLASS__ . '{' .
            'parent:' . parent::__toString() .
            ', unit=' . $this->getUnit() .
            '}';
    }

}

Ingredient::init();