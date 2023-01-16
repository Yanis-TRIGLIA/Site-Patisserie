<?php

final class Ustensil {

    private static $sql = "SELECT NAME FROM USTENSIL WHERE ID_USTENSIL=?";
    private static $req_prep;

    public static function getById($id){
        if (is_null(self::$req_prep))
            self::$req_prep = modele::$pdo->prepare(self::$sql);
        self::$req_prep->execute(array($id));
        $row = self::$req_prep->fetch();
        return new Ustensil($id, $row['NAME']);
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