<?php

final class Ingredient {

    private static $sql = 'SELECT NAME, UNIT FROM INGREDIENT WHERE ID_INGREDIENT=?';
    private static $sql2 = 'INSERT INTO INGREDIENT (NAME, UNIT) VALUES (?, ?)';
    private static $req_prep;
    private static $req_prep2;

    static function prepare() {
        self::$req_prep = modele::$pdo->prepare(self::$sql);
        self::$req_prep2 = modele::$pdo->prepare(self::$sql2);
    }

    public static function getById($id, $quantity) {
        self::$req_prep->execute(array($id));
        $row = self::$req_prep->fetch();
        return new Ingredient($id, $row['NAME'], $quantity, $row['UNIT']);
    }

    public static function createIngredient($name, $unit) {
        self::$req_prep2->execute(array($name, $unit));
    }

    private $id;
    private $name;
    private $quantity;
    private $unit;

    private function __construct($id, $name, $quantity, $unit){
        $this-> id = $id;
        $this->name = $name;
        $this->unit = $unit;
    }

    public function getName(){
        return $this->name;
    }

    public function getId(){
        return $this->id;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function getUnit(){
        return $this->unit;
    }

    public function __toString() {
        return "Ingredient{id=" . $this->getId() . ", name=" . $this->getName() . ', quantity=' . $this->getQuantity() . "}";
    }

}

Ingredient::prepare();