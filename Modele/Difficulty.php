<?php

final class Difficulty extends DbObject {

    private static $sql = 'SELECT NAME FROM DIFFICULTY WHERE ID_DIFFICULTY=?';
    private static $sql2 = 'INSERT INTO DIFFICULTY (NAME) VALUES (?)';
    private static $req_prep;
    private static $req_prep2;

    static function prepare() {
        self::$req_prep = modele::$pdo->prepare(self::$sql);
        self::$req_prep2 = modele::$pdo->prepare(self::$sql2);
    }

    public static function getById($id){
        self::$req_prep->execute(array($id));
        $row = self::$req_prep->fetch();
        return new Difficulty($id, $row['NAME']);
    }

    public static function createDifficulty($name) {
        self::$req_prep2->execute(array($name));
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
            '}';
    }

}

Difficulty::prepare();