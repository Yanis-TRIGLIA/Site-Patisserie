<?php


class ControleurHome
{

    public function defautAction()
    {
        $nums = array();
        while (count($nums) < 3) {
            $num = rand(1, 5);
            if (!in_array($num, $nums)) {
                $nums[] = $num;
            }
        }
        $num1 = $nums[0];
        $num2 = $nums[1];
        $num3 = $nums[2];
        $O_recipe1 = Recipe::getById($num1);
        $O_recipe2 = Recipe::getById($num2);
        $O_recipe3 = Recipe::getById($num3);
        Vue::montrer('standard/entete', array("home" => "Home"));
        Vue::montrer('standard/navbar');

        $averageGrade1 = $this->averageGrade1($O_recipe1);
        $averageGrade2 = $this->averageGrade2($O_recipe2);
        $averageGrade3 = $this->averageGrade3($O_recipe3);
        $difficulty1 = $this->difficulty1($O_recipe1);
        $difficulty2 = $this->difficulty2($O_recipe2);
        $difficulty3 = $this->difficulty3($O_recipe3);
        $recipe1 = [$O_recipe1->getImageUrl(), $O_recipe1->getName(), $difficulty1, $O_recipe1->getDuration(), $averageGrade1, $O_recipe1->getId()];
        $recipe2 = [$O_recipe2->getImageUrl(), $O_recipe2->getName(), $difficulty2, $O_recipe2->getDuration(), $averageGrade2, $O_recipe2->getId()];
        $recipe3 = [$O_recipe3->getImageUrl(), $O_recipe3->getName(), $difficulty3, $O_recipe3->getDuration(), $averageGrade3, $O_recipe3->getId()];
        $array = [$recipe1, $recipe2, $recipe3];
        Vue::montrer('home/SlideShow', $array);
    }
    private function averageGrade1($O_recipe1)
    {
        $average = 0;
        $sum = 0;
        $appreciations = $O_recipe1->getAppreciations();
        for ($i = 0; $i < sizeof($appreciations); ++$i) {
            $sum += $appreciations[$i]->getGrade();
        }
        $average = $sum / sizeof($appreciations);
        return $average;
    }
    private function averageGrade2($O_recipe2)
    {
        $average = 0;
        $sum = 0;
        $appreciations = $O_recipe2->getAppreciations();
        for ($i = 0; $i < sizeof($appreciations); ++$i) {
            $sum += $appreciations[$i]->getGrade();
        }
        $average = $sum / sizeof($appreciations);
        return $average;
    }
    private function averageGrade3($O_recipe3)
    {
        $average = 0;
        $sum = 0;
        $appreciations = $O_recipe3->getAppreciations();
        for ($i = 0; $i < sizeof($appreciations); ++$i) {
            $sum += $appreciations[$i]->getGrade();
        }
        $average = $sum / sizeof($appreciations);
        return $average;
    }
    private function difficulty1($O_recipe1)
    {

        $difficulty = $O_recipe1->getDifficulty();
        for ($i = 0; $i < ($difficulty); ++$i) {
            $level = $difficulty->getName();
        }
        return $level;
    }
    private function difficulty2($O_recipe2)
    {

        $difficulty = $O_recipe2->getDifficulty();
        for ($i = 0; $i < ($difficulty); ++$i) {
            $level = $difficulty->getName();
        }
        return $level;
    }
    private function difficulty3($O_recipe3)
    {

        $difficulty = $O_recipe3->getDifficulty();
        for ($i = 0; $i < ($difficulty); ++$i) {
            $level = $difficulty->getName();
        }
        return $level;
    }

    private function difficulty($recipe)
    {

        $difficulty = $recipe->getDifficulty();
        for ($i = 0; $i < ($difficulty); ++$i) {
            $level = $difficulty->getName();
        }
        return $level;
    }

    public function searchAction()
    {
        $query = $_POST['query'];
        $searchResults = Search::searchByName($query);
        $array = [];
        foreach ($searchResults as $result) {
            $difficulty = $this->difficulty($result);
            $recipe = [$result->getImageUrl(), $result->getName(), $difficulty, $result->getDuration(), $result->getId()];
            array_push($array, $recipe);
        }
        Vue::montrer('home/SearchResults', $array);
    }
    public function filterAction()
    {
        $difficulty = $_POST['difficulty'];
        $name = $_POST['name'];
        $duration = $_POST['duration'];
        $filteredResults = [];
        $allResults = Search::searchByName($name);
        foreach ($allResults as $result) {
            $resultDifficulty = $this->difficulty($result);
            if ($resultDifficulty == $difficulty && $result->getName() == $name && $result->getDuration() == $duration) {
                $recipe = [$result->getImageUrl(), $result->getName(), $resultDifficulty, $result->getDuration(), $result->getId()];
                array_push($filteredResults, $recipe);
            }
            else if($resultDifficulty == $difficulty && $result->getDuration() == $duration){
                $recipe = [$result->getImageUrl(), $result->getName(), $resultDifficulty, $result->getDuration(), $result->getId()];
                array_push($filteredResults, $recipe);

            }
            else if( $duration == $result->getDuration() || $result->getDuration() == $duration +5|| $result->getDuration() == $duration +5){
                $recipe = [$result->getImageUrl(), $result->getName(), $resultDifficulty, $result->getDuration(), $result->getId()];
                array_push($filteredResults, $recipe);

            }
            else if($resultDifficulty == $difficulty ){
                $recipe = [$result->getImageUrl(), $result->getName(), $resultDifficulty, $result->getDuration(), $result->getId()];
                array_push($filteredResults, $recipe);

            }
            else if($result->getName() == $name){
                $recipe = [$result->getImageUrl(), $result->getName(), $resultDifficulty, $result->getDuration(), $result->getId()];
                array_push($filteredResults, $recipe);

            }
        }
        Vue::montrer('home/SearchResults', $filteredResults);
    }
}
