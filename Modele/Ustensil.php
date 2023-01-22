<?php

final class Ustensil extends DbObject {

    private static $sql = 'SELECT NAME FROM USTENSIL WHERE ID_USTENSIL=?';
    private static $sql2 = 'INSERT INTO USTENSIL (NAME) VALUES (?)';
    private static $req_prep;
    private static $req_prep2;

    static function prepare() {
        self::$req_prep = modele::$pdo->prepare(self::$sql);
        self::$req_prep2 = modele::$pdo->prepare(self::$sql2);
    }

    public static function getById($id){
        self::$req_prep->execute(array($id));
        $row = self::$req_prep->fetch();
        return new Ustensil($id, $row['NAME']);
    }

    public static function createUstensil($name) {
        self::$req_prep2->execute($name);
    }

	/**
	 * Insert **this** Ustensil in the database
	 * It also set **this** id to the given auto-incremented id in database
	 * @return void
	 */
	public function insert() {
	}
	
	/**
	 * Put **this** Ustensil attributes in database
	 * @return void
	 */
	public function update() {
	}
	
	/**
	 * Put database attributes in **this** Ustensil
	 * @return void
	 */
	public function refresh() {
	}
	
	/**
	 * Delete **this** Ustensil in the database
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

Ustensil::prepare();