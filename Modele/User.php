<?php

/**
 * Object representing an user through database
 */
final class User extends DbObject {

    private static $reqManager;

    static function init() {
        self::$reqManager = new RequestsManager('USER');
        self::$reqManager->add('select_row', 'SELECT * FROM USER WHERE ID_USER=?');
        self::$reqManager->add('select_by_login', 'SELECT * FROM USER WHERE LOGIN=?');
		self::$reqManager->add('insert_row', 'INSERT INTO USER (NAME, LOGIN, HASHED_PASSWORD, FIRST_SEEN, LAST_SEEN, PP_URL) VALUES (?, ?, ?, ?, ?, ?)');
		self::$reqManager->add('update_row', 'UPDATE USER SET NAME=?, LOGIN=?, HASHED_PASSWORD=?, FIRST_SEEN=?, LAST_SEEN=?, PP_URL=? WHERE ID_USER=?');
		self::$reqManager->add('delete_row', 'DELETE FROM USER WHERE ID_USER=?');
    }
    
    /**
	 * Get all the existing users
	 * @return array An array containing all users
	 */
	public static function getAll() {
		$req_output = self::$reqManager->execute('*');
		$all_users = array();
		while ($attr = $req_output->fetch())
			array_push($all_users, new User($attr['ID_USER'], $attr['NAME'], $attr['LOGIN'], $attr['HASHED_PASSWORD'], $attr['FIRST_SEEN'], $attr['LAST_SEEN'], $attr['PP_URL']));
		return $all_users;
	}

	/**
	 * Get the user associated to the given id
	 * @param int $id The given id
	 * @return User The user associated to the id
	 */
    public static function getById($id) {
        $attr = self::$reqManager->execute('select_row', array($id))->fetch();
        return new User($attr['ID_USER'], $attr['NAME'], $attr['LOGIN'], $attr['HASHED_PASSWORD'], $attr['FIRST_SEEN'], $attr['LAST_SEEN'], $attr['PP_URL']);
    }

    /**
     * Get the user associated to the given login
     * @param string $login
     * @return User
     */
    public static function getByLogin($login) {
        $attr = self::$reqManager->execute('select_by_login', array($login))->fetch();
        return new User($attr['ID_USER'], $attr['NAME'], $attr['LOGIN'], $attr['HASHED_PASSWORD'], $attr['FIRST_SEEN'], $attr['LAST_SEEN'], $attr['PP_URL']);
    }

    private $login;
    private $hashedPassword;
    private $firstSeen;
    private $lastSeen;
    private $ppUrl;
    
    public function __construct(?int $id, $name, $login, $hashedPassword, $firstSeen, $lastSeen, $ppUrl){
        parent::__construct($id, $name);
        $this->login = $login;
        $this->hashedPassword = $hashedPassword;
        $this->firstSeen= $firstSeen;
        $this->lastSeen = $lastSeen;
        $this->ppUrl = $ppUrl;
    }
    
    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function setHashedPassword($hashedPassword) {
        $this->hashedPassword = $hashedPassword;
    }

    public function getFirstSeen() {
        return $this->firstSeen;
    }

    public function setFirstSeen($firstSeen) {
        $this->lastSeen = $firstSeen;
    }

    public function getLastSeen() {
        return $this->lastSeen;
    }

    public function setLastSeen($lastSeen) {
        $this->getLastSeen();
    }

    public function getPpUrl() {
        return $this->ppUrl;
    }

    public function setPpUrl($ppUrl) {
        $this->ppUrl = $ppUrl;
    }

	/**
	 * Insert **this** User in the database
	 * It also set **this** id to the given auto-incremented id in database
	 * @return void
	 */
	public function insert() {
        self::$reqManager->execute('insert_row', array($this->getName(), $this->getLogin(), $this->getHashedPassword(), $this->getFirstSeen(), $this->getLastSeen(), $this->getPpUrl()));
		$this->setId(modele::$pdo->lastInsertId());
	}
	
	/**
	 * Put **this** User attributes in database
	 * @return void
	 */
	public function update() {
        self::$reqManager->execute('update_row', array($this->getName(), $this->getLogin(), $this->getHashedPassword(), $this->getFirstSeen(), $this->getLastSeen(), $this->getPpUrl(), $this->getId()));
	}
	
	/**
	 * Put database attributes in **this** User
	 * @return void
	 */
	public function refresh() {
        $row = self::$reqManager->execute('select_row', array($this->getId()))->fetch();
		$this->setName($row['NAME']);
        $this->setLogin($row['LOGIN']);
        $this->setHashedPassword($row['HASHED_PASSWORD']);
        $this->setFirstSeen($row['FIRST_SEEN']);
        $this->setLastSeen($row['LAST_SEEN']);
        $this->setPpUrl($row['PP_URL']);
	}
	
	/**
	 * Delete **this** User in the database
	 * @return void
	 */
	public function delete() {
        self::$reqManager->execute('delete_row', array($this->getId()));
	}

    public function __toString() {
        return __CLASS__ . '{' .
            'parent:' . parent::__toString() .
            ', login=' . $this->getLogin() .
            ', hashedPassword=' . $this->getHashedPassword() .
            ', firstSeen=' . $this->getFirstSeen() .
            ', lastSeen=' . $this->getLastSeen() .
            ', ppUrl=' . $this->getPpUrl() .
            '}';
    }

}

User::init();