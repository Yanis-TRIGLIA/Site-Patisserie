<?php

final class User{

    private static $sql = 'SELECT LOGIN,DISPLAY_NAME,DATE_FORMAT(FIRST_SEEN, "%d %b %Y") AS FIRST_SEEN, DATE_FORMAT(LAST_SEEN, "%d %b %Y") AS LAST_SEEN, PP_URL FROM USER WHERE ID_USER=?';
    private static $sql2 = 'INSERT INTO (LOGIN, HASHED_PASSWORD, DISPLAY_NAME, FIRT_SEEN, LAST_SEEN, PP_URL) VALUES (?, ?, ?, ?, ?, ?)';
    private static $req_prep;
    private static $req_prep2;

    static function prepare() {
        self::$req_prep = modele::$pdo->prepare(self::$sql);
        self::$req_prep2 = modele::$pdo->prepare(self::$sql2);
    }

    public static function getById($id){
        self::$req_prep->execute(array($id));
        $row = self::$req_prep->fetch();
        return new User($id, $row['LOGIN'],$row ['DISPLAY_NAME'], $row['FIRST_SEEN'],$row['LAST_SEEN'], $row['PP_URL']);
    }

    public static function createUser($login, $displayName, $firstSeen, $lastSeen, $ppUrl) {
        self::$req_prep2->execute(array($login, $displayName, $firstSeen, $lastSeen, $ppUrl));
    }

    private $id;
    private $login;
    private $displayName;
    private $firstSeen;
    private $lastSeen;
    private $ppUrl;
    
    private function __construct($id, $login, $displayName, $firstSeen, $lastSeen, $ppUrl){
        $this-> id = $id;
        $this->login = $login;
        $this-> displayName= $displayName;
        $this-> firstSeen= $firstSeen;
        $this->lastSeen = $lastSeen;
        $this->ppUrl = $ppUrl;
    }
    
    public function getId(){
        return $this->id;              
    }

    public function getLogin(){
        return $this->login;              
    }

    public function getDisplayName(){
        return $this->displayName;
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

    public function __toString() {
        return "User{id=" . $this->getId() . ", login=" . $this->getLogin() . ", displayName=" . $this->getDisplayName() . ", firstSeen=" . $this->getFirstSeen() . ", lastSeen=" . $this->getLastSeen() . ", ppUrl=" . $this->getPpUrl() . "}";
    }

}

User::prepare();