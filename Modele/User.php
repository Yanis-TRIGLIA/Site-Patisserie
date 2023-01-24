<?php

/**
 * Object representing an user through database
 */
final class User extends DbObject {

    private static $sql = 'SELECT LOGIN,NAME,DATE_FORMAT(FIRST_SEEN, "%d %b %Y") AS FIRST_SEEN, DATE_FORMAT(LAST_SEEN, "%d %b %Y") AS LAST_SEEN, PP_URL FROM USER WHERE ID_USER=?';
    private static $sql2 = 'INSERT INTO (LOGIN, HASHED_PASSWORD, NAME, FIRT_SEEN, LAST_SEEN, PP_URL) VALUES (?, ?, ?, ?, ?, ?)';
    private static $req_prep;
    private static $req_prep2;

    static function prepare() {
        self::$req_prep = modele::$pdo->prepare(self::$sql);
        self::$req_prep2 = modele::$pdo->prepare(self::$sql2);
    }

    public static function getById($id){
        self::$req_prep->execute(array($id));
        $row = self::$req_prep->fetch();
        return new User($id, $row['LOGIN'],$row ['NAME'], $row['FIRST_SEEN'],$row['LAST_SEEN'], $row['PP_URL']);
    }

    public static function createUser($login, $name, $firstSeen, $lastSeen, $ppUrl) {
        self::$req_prep2->execute(array($login, $name, $firstSeen, $lastSeen, $ppUrl));
    }

    private $login;
    private $firstSeen;
    private $lastSeen;
    private $ppUrl;
    
    private function __construct(?int $id, $name, $login, $firstSeen, $lastSeen, $ppUrl){
        parent::__construct($id, $name);
        $this->login = $login;
        $this-> firstSeen= $firstSeen;
        $this->lastSeen = $lastSeen;
        $this->ppUrl = $ppUrl;
    }
    
    public function getLogin(){
        return $this->login;              
    }

    public function getFirstSeen(){
        return $this->firstSeen;
    }

    public function getLastSeen(){
        return $this->lastSeen;              
    }

    public function getPpUrl() {
        return $this->ppUrl;
    }

	/**
	 * Insert **this** User in the database
	 * It also set **this** id to the given auto-incremented id in database
	 * @return void
	 */
	public function insert() {
	}
	
	/**
	 * Put **this** User attributes in database
	 * @return void
	 */
	public function update() {
	}
	
	/**
	 * Put database attributes in **this** User
	 * @return void
	 */
	public function refresh() {
	}
	
	/**
	 * Delete **this** User in the database
	 * @return void
	 */
	public function delete() {
	}

    public function __toString() {
        return __CLASS__ . '{' .
            'parent:' . parent::__toString() .
            ', login=' . $this->getLogin() .
            ', firstSeen=' . $this->getFirstSeen() .
            ', lastSeen=' . $this->getLastSeen() .
            ', ppUrl=' . $this->getPpUrl() .
            '}';
    }

}

User::prepare();