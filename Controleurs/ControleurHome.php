<?php

class ControleurHome {

    public function defautAction() {
        $num1 = rand(1,3);
        $num2 = rand(1,3);
        $num3 = rand(1,3);
        $O_recipe1 = Recipe::getById($num1);
        $O_recipe2 = Recipe::getById($num2);
        $O_recipe3 = Recipe::getById($num3);
        Vue::montrer('standard/entete');
        Vue::montrer('standard/navbar');

        $averageGrade1 = $this->averageGrade1($O_recipe1);
        $averageGrade2 = $this->averageGrade2($O_recipe2);
        $averageGrade3 = $this->averageGrade3($O_recipe3);
        $recipe1 = [$O_recipe1->getImageUrl(),$O_recipe1->getName(),$O_recipe1->getDifficulty(),$O_recipe1->getDuration(),$averageGrade1];
        $recipe2 = [$O_recipe2->getImageUrl(),$O_recipe2->getName(),$O_recipe2->getDifficulty(),$O_recipe2->getDuration(),$averageGrade2];
        $recipe3 = [$O_recipe3->getImageUrl(),$O_recipe3->getName(),$O_recipe3->getDifficulty(),$O_recipe3->getDuration(),$averageGrade3];
        $array = [$recipe1,$recipe2,$recipe3];
        Vue::montrer('Home/caroussel',$array);

    }
    private function averageGrade1($O_recipe1)
    {
        $average = 0;
        $sum = 0;
        $appreciations = $O_recipe1->getAppreciations();
        for ($i=0; $i<sizeof($appreciations);++$i){
            $sum += $appreciations[$i]->getGrade();
        }
        $average = $sum/sizeof($appreciations);
        return $average;
    }
    private function averageGrade2($O_recipe2)
    {
        $average = 0;
        $sum = 0;
        $appreciations = $O_recipe2->getAppreciations();
        for ($i=0; $i<sizeof($appreciations);++$i){
            $sum += $appreciations[$i]->getGrade();
        }
        $average = $sum/sizeof($appreciations);
        return $average;
    }
    private function averageGrade3($O_recipe3)
    {
        $average = 0;
        $sum = 0;
        $appreciations = $O_recipe3->getAppreciations();
        for ($i=0; $i<sizeof($appreciations);++$i){
            $sum += $appreciations[$i]->getGrade();
        }
        $average = $sum/sizeof($appreciations);
        return $average;
    }
}