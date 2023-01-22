<?php

final class Ingredient extends DbObject {

    private static $sql = 'SELECT NAME, UNIT FROM INGREDIENT WHERE ID_INGREDIENT=?';
    private static $sql2 = 'INSERT INTO INGREDIENT (NAME, UNIT) VALUES (?, ?)';
    private static $req_prep;
    private static $req_prep2;

    static function prepare() {
        self::$req_prep = modele::$pdo->prepare(self::$sql);
        self::$req_prep2 = modele::$pdo->prepare(self::$sql2);
    }

    public static function getById($id) {
        self::$req_prep->execute(array($id));
        $row = self::$req_prep->fetch();
        return new Ingredient($id, $row['NAME'], $row['UNIT']);
    }

    public static function createIngredient($name, $unit) {
        self::$req_prep2->execute(array($name, $unit));
    }

    private $unit;

    private function __construct($id, $name, $unit){
        parent::__construct($id, $name);
        $this->unit = $unit;
    }

    public function getUnit(){
        return $this->unit;
    }

	/**
	 * Insert **this** Ingredient in the database
	 * It also set **this** id to the given auto-incremented id in database
	 * @return void
	 */
	public function insert() {
	}
	
	/**
	 * Put **this** Ingredient attributes in database
	 * @return void
	 */
	public function update() {
	}
	
	/**
	 * Put database attributes in **this** Ingredient
	 * @return void
	 */
	public function refresh() {
	}
	
	/**
	 * Delete **this** Ingredient in the database
	 * @return void
	 */
	public function delete() {
	}

    public function __toString() {
        return __CLASS__ . '{' .
            'parent:' . parent::__toString() .
            ', unit=' . $this->getUnit() .
            '}';
    }

}

Ingredient::prepare();