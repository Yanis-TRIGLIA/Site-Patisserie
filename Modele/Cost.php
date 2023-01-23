<?php

/**
 * Object representing a cost through database
 */
final class Cost extends DbObject {

	private static $reqManager = new RequestsManager('COST');

    static function init() {
		self::$reqManager->add('insert', 'INSERT INTO COST VALUES (?, ?)');
    }

    public static function getById($id) {
		echo 1;
        $row = self::$reqManager->execute('by_id', array($id))->fetch();
		echo 2;
        return new Cost($row['ID'], $row['NAME']);
    }

	/**
	 * Insert **this** Cost in the database
	 * It also set **this** id to the given auto-incremented id in database
	 * @return void
	 */
	public function insert() {
		self::$reqManager->execute('insert', array($this->getId(), $this->getName()));
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

Cost::init();