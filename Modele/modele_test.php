<?php
//require_once(File::build_path(array("Modele", "modele.php")));


class modele_test{
 
  public static function readAll(){
    $sql = "SELECT * FROM USTENSIL";
    $rep = modele::$pdo->query($sql);
    $rep->setFetchMode(PDO::FETCH_CLASS, 'modele_test');
    return $rep->fetchAll();
}


}