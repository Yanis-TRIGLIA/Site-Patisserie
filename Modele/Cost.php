<?php

final class Cost {

    private static $sql = 'SELECT NAME FROM COST WHERE ID_COST=?';
    private static $sql2 = 'INSERT INTO COST (NAME) VALUES (?)';
    private static $req_prep = modele::$pdo->prepare(self::$sql);
    private static $req_prep2 = modele::$pdo->prepare(self::$sql2);

    public static function getById($id){
        self::$req_prep->execute(array($id));
        $row = self::$req_prep->fetch();
        return new Cost($id, $row['NAME']);
    }

    public static function createCost($name) {
        self::$req_prep2->execute(array($name));
    }

    private $id;
    private $name;

    private function __construct($id, $name){
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
        return "Cost{id=" . $this->getId() . ", name=" . $this->getName() . "}";
    }

}