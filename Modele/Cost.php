<?php

/**
 * Object representing a cost through database
 */
final class Cost extends DbObject {

    private static $sql = 'SELECT NAME FROM COST WHERE ID_COST=?';
    private static $sql2 = 'INSERT INTO COST (NAME) VALUES (?)';
    private static $req_prep;
    private static $req_prep2;

    static function prepare() {
        self::$req_prep = modele::$pdo->prepare(self::$sql);
        self::$req_prep2 = modele::$pdo->prepare(self::$sql2);
    }

    public static function getById($id){
        self::$req_prep->execute(array($id));
        $row = self::$req_prep->fetch();
        return new Cost($id, $row['NAME']);
    }

    public static function createCost($name) {
        self::$req_prep2->execute(array($name));
    }

	/**
	 * Insert **this** Cost in the database
	 * It also set **this** id to the given auto-incremented id in database
	 * @return void
	 */
	public function insert() {
	}
	
	/**
	 * Put **this** Cost attributes in database
	 * @return void
	 */
	public function update() {
	}
	
	/**
	 * Put database attributes in **this** Cost
	 * @return void
	 */
	public function refresh() {
	}
	
	/**
	 * Delete **this** Cost in the database
	 * @return void
	 */
	public function delete() {
	}

    public function __toString() {
        return __CLASS__ . '{' .
            'parent:' . parent::__toString() .
            '}';
    }

}

Cost::prepare();