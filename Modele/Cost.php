<?php

/**
 * Object representing a cost through database
 */
final class Cost extends DbObject {

	private static $reqManager;

    static function init() {
		self::$reqManager = new RequestsManager('COST');
		self::$reqManager->add('insert', 'INSERT INTO COST (NAME) VALUES (?)');
		self::$reqManager->add('update', 'UPDATE COST SET NAME=? WHERE ID_COST=?');
        // self::$reqManager->add('delete', 'DELETE FROM COST WHERE ID_COST=?');
    }

    public static function getById($id) {
        $row = self::$reqManager->execute('by_id', array($id))->fetch();
        return new Cost($row['ID_COST'], $row['NAME']);
    }

	/**
	 * Insert **this** Cost in the database
	 * It also set **this** id to the given auto-incremented id in database
     * Be careful ! It doesn't check if object is already in database
	 * @return void
	 */
	public function insert() {
		self::$reqManager->execute('insert', array($this->getName()));
		$this->setId(modele::$pdo->lastInsertId());
	}
	
	/**
	 * Put **this** Cost attributes in database
	 * @return void
	 */
	public function update() {
		self::$reqManager->execute('update', array($this->getName(), $this->getId()));
	}
	
	/**
	 * Put database attributes in **this** Cost
	 * @return void
	 */
	public function refresh() {
		$row = self::$reqManager->execute('by_id', array($this->getId()))->fetch();
		$this->setName($row['NAME']);
	}
	
	/**
	 * Delete **this** Cost in the database
	 * @return void
	 */
	public function delete() {
		// self::$reqManager->execute('delete', array($this->getId()));
	}

    public function __toString() {
        return __CLASS__ . '{' .
            'parent:' . parent::__toString() .
            '}';
    }

}

Cost::init();