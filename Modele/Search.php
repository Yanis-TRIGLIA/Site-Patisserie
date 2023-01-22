<?php


final class Search {
    public static function searchByName($query) {
        $sql = 'SELECT * FROM RECIPE WHERE NAME LIKE ?';
        $req = modele::$pdo->prepare($sql);
        $req->execute(array("%".$query."%"));
        $results = array();
        while ($row = $req->fetch()) {
            $results[] = new Search($query, $row['ID_RECIPE'], $row['NAME'], $row['DURATION'], Difficulty::getById($row['ID_DIFFICULTY']), $row['IMAGE_URL']);
        }
        return $results;
    }
    private $query;
    private $id;
    private $name;
    private $duration;
    private $difficulty;
    private $imageUrl;

    private function __construct($query, $id, $name, $duration, $difficulty, $imageUrl) {
        $this->query = $query;
        $this->id = $id;
        $this->name = $name;
        $this->duration = $duration;
        $this->difficulty = $difficulty;
        $this->imageUrl = $imageUrl;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDuration() {
        return $this->duration;
    }

    public function getDifficulty() {
        return $this->difficulty;
    }

    public function getImageUrl() {
        return $this->imageUrl;
    }

    public function __toString() {
        return "Recipe{id=" . $this->getId() . ", name=" . $this->getName() . ", duration=" . $this->getDuration() . ", difficulty=" . $this->getDifficulty() . $this->getImageUrl() . "}";
    }
}
