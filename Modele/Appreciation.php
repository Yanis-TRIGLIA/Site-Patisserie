<?php

final class Appreciation{

    private static $sql1 = 'SELECT ID_RECIPE,ID_AUTHOR,DATE_FORMAT(PUBLICATION_DATE , "%d %b %Y") AS PUBLICATION_DATE ,GRADE,COMMENTARY FROM APPRECIATION WHERE ID_APPRECIATION=?';

    private static $req_prep1;

    public static function getById($id) {
        if (is_null(self::$req_prep1))
            self::$req_prep1 = modele::$pdo->prepare(self::$sql1);
        self::$req_prep1->execute(array($id));
        $row = self::$req_prep1->fetch();
        return new Appreciation($id,$row['ID_RECIPE'],User::getById($row['ID_AUTHOR']),$row['PUBLICATION_DATE'],$row['GRADE'],$row['COMMENTARY']);
    }

    private $id;
    private $id_recipe;
    private $author;
    private $publication_date;
    private $grade;
    private $commentary;

    private function __construct($id, $id_recipe, $author,$publication_date, $grade, $commentary){
        $this-> id = $id;
        $this->id_recipe = $id_recipe;
        $this->author = $author;
        $this-> publication_date= $publication_date;
        $this-> grade= $grade;
        $this->commentary = $commentary;
    }
    
    public function getId(){
        return $this->id;
    }

    public function getIdRecipe(){
        return $this->id_recipe;
    }
    public function getAuthor(){
        return $this->author;              
    }

    public function getDate(){
        return $this->publication_date;
    }

    public function getGrade(){
        return $this->grade;
    }

    public function getCommentary(){
        return $this->commentary;              
    }

    public function __toString() {
        return "Appreciation{id=" . $this->getId() . ", recipe=" . $this->getIdRecipe() .", author=" . $this->getAuthor(). ", date=" . $this->getDate() . ", grade=" . $this->getGrade() . ", commentary=" . $this->getCommentary(). "}";
    }

}