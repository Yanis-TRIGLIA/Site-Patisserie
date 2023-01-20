<?php

final class Appreciation{

    private static $sql1 = 'SELECT ID_RECIPE,ID_AUTHOR,DATE_FORMAT(PUBLICATION_DATE , "%d %b %Y") AS PUBLICATION_DATE ,GRADE,COMMENTARY FROM APPRECIATION WHERE ID_APPRECIATION=?';
    private static $sql2 = 'INSERT INTO APPRECIATION (ID_RECIPE, ID_AUTHOR, PUBLICATION_DATE, GRADE, COMMENTARY) VALUES (?, ?, ?, ?, ?)';
    private static $req_prep1;
    private static $req_prep2;

    static function prepare() {
        self::$req_prep1 = modele::$pdo->prepare(self::$sql1);
        self::$req_prep2 = modele::$pdo->prepare(self::$sql2);
    }


    public static function getById($id) {
        self::$req_prep1->execute(array($id));
        $row = self::$req_prep1->fetch();
        return new Appreciation($id,$row['ID_RECIPE'],User::getById($row['ID_AUTHOR']),$row['PUBLICATION_DATE'],$row['GRADE'],$row['COMMENTARY']);
    }

    public static function createAppreciation($recipe, $author, $publicationDate, $grade, $commentary) {
        self::$req_prep2->execute(array($recipe->getId(), $author->getId(), $publicationDate, $grade, $commentary));
    }

    private $id;
    private $idRecipe;
    private $author;
    private $publicationDate;
    private $grade;
    private $commentary;

    private function __construct($id, $idRecipe, $author,$publicationDate, $grade, $commentary){
        $this-> id = $id;
        $this->idRecipe = $idRecipe;
        $this->author = $author;
        $this-> publicationDate= $publicationDate;
        $this-> grade= $grade;
        $this->commentary = $commentary;
    }
    
    public function getId(){
        return $this->id;
    }

    public function getIdRecipe(){
        return $this->idRecipe;
    }
    public function getAuthor(){
        return $this->author;              
    }

    public function getDate(){
        return $this->publicationDate;
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

Appreciation::prepare();