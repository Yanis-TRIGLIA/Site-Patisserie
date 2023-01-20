<?php

final class Ustensil {

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

    private $id;
    private $name;

    private function __construct($id,$name){
        $this-> id = $id;
        $this->name = $name;
        
    }

    public function getName(){
        return $this->name;              
    }

    public function getId(){
        return $this->id;              
    }

    public function __toString() {
        return "Ustensil{id=" . $this->getId() . ", name=" . $this->getName() . "}";
    }

}

Ustensil::prepare();