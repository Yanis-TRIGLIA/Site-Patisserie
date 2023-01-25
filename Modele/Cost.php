<?php

/**
 * Object representing a cost through database
 */
final class Cost extends DbObject {

	private static $reqManager;

    static function init() {
		self::$reqManager = new RequestsManager('COST');
        self::$reqManager->add('select_row', 'SELECT * FROM COST WHERE ID_COST=?');
		self::$reqManager->add('insert_row', 'INSERT INTO COST (NAME) VALUES (?)');
		self::$reqManager->add('update_row', 'UPDATE COST SET NAME=? WHERE ID_COST=?');
		self::$reqManager->add('delete_row', 'DELETE FROM COST WHERE ID_COST=?');
    }

	/**
	 * Get all the existing costs
	 * @return array An array containing all costs
	 */
	public static function getAll() {
		$req_output = self::$reqManager->execute('*');
		$all_costs = array();
		while ($attr = $req_output->fetch())
			array_push($all_costs, new Cost($attr['ID_COST'], $attr['NAME']));
		return $all_costs;
	}

	/**
	 * Get the cost associated to the given id
	 * @param int $id The given id
	 * @return Cost The cost associated to the id
	 */
    public static function getById($id) {
        $attr = self::$reqManager->execute('select_row', array($id))->fetch();
        return new Cost($attr['ID_COST'], $attr['NAME']);
    }

	/**
	 * Insert **this** Cost in the database
	 * It also set **this** id to the given auto-incremented id in database
     * Be careful ! It doesn't check if object is already in database
	 */
	public function insert() {
		self::$reqManager->execute('insert_row', array($this->getName()));
		$this->setId(modele::$pdo->lastInsertId());
	}
	
	/**
	 * Put **this** Cost attributes in database
	 * @return void
	 */
	public function update() {
		self::$reqManager->execute('update_row', array($this->getName(), $this->getId()));
	}
	
	/**
	 * Put database attributes in **this** Cost
	 * @return void
	 */
	public function refresh() {
		$row = self::$reqManager->execute('select_row', array($this->getId()))->fetch();
		$this->setName($row['NAME']);
	}
	
	/**
	 * Delete **this** Cost in the database
	 * @return void
	 */
	public function delete() {
		self::$reqManager->execute('delete_row', array($this->getId()));
	}

    public function __toString() {
        return __CLASS__ . '{' .
            'parent:' . parent::__toString() .
            '}';
    }

}

Cost::init();