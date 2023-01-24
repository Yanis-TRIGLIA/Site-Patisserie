<?php

/**
 * Object representing an ustensil through database
 */
final class Ustensil extends DbObject {

	private static $reqManager;

    private static $sql = 'SELECT NAME FROM USTENSIL WHERE ID_USTENSIL=?';
    private static $sql2 = 'INSERT INTO USTENSIL (NAME) VALUES (?)';
    private static $req_prep;
    private static $req_prep2;

    static function init() {
        self::$reqManager = new RequestsManager('USTENSIL');
        self::$reqManager->add('select_row', 'SELECT * FROM USTENSIL WHERE ID_USTENSIL=?');
		self::$reqManager->add('insert_row', 'INSERT INTO USTENSIL (NAME) VALUES (?)');
		self::$reqManager->add('update_row', 'UPDATE USTENSIL SET NAME=? WHERE ID_USTENSIL=?');
		self::$reqManager->add('delete_row', 'DELETE FROM USTENSIL WHERE ID_USTENSIL=?');
    }

    /**
	 * Get all the existing ustensils
	 * @return array An array containing all ustensils
	 */
	public static function getAll() {
		$req_output = self::$reqManager->execute('*');
		$all_costs = array();
		while ($attr = $req_output->fetch())
			array_push($all_costs, new Cost($attr['ID_USTENSIL'], $attr['NAME']));
		return $all_costs;
	}

	/**
	 * Get the ustensil associated to the given id
	 * @param int $id The given id
	 * @return Ustensil The cost associated to the id
	 */
    public static function getById($id) {
        $attr = self::$reqManager->execute('select_row', array($id))->fetch();
        return new Ustensil($attr['ID_USTENSIL'], $attr['NAME']);
    }

	/**
	 * Insert **this** Ustensil in the database
	 * It also set **this** id to the given auto-incremented id in database
	 * @return void
	 */
	public function insert() {
		self::$reqManager->execute('insert_row', array($this->getName()));
		$this->setId(modele::$pdo->lastInsertId());
	}
	
	/**
	 * Put **this** Ustensil attributes in database
	 * @return void
	 */
	public function update() {
		self::$reqManager->execute('update_row', array($this->getName(), $this->getId()));
	}
	
	/**
	 * Put database attributes in **this** Ustensil
	 * @return void
	 */
	public function refresh() {
		$row = self::$reqManager->execute('select_row', array($this->getId()))->fetch();
		$this->setName($row['NAME']);
	}
	
	/**
	 * Delete **this** Ustensil in the database
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

Ustensil::init();