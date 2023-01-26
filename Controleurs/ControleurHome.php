<?php
session_start();

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

        $averageGrade1 = $this->averageGrade($O_recipe1);
        $averageGrade2 = $this->averageGrade($O_recipe2);
        $averageGrade3 = $this->averageGrade($O_recipe3);
        $difficulty1 = $this->difficulty($O_recipe1);
        $difficulty2 = $this->difficulty($O_recipe2);
        $difficulty3 = $this->difficulty($O_recipe3);
        $recipe1 = [$O_recipe1->getImageUrl(), $O_recipe1->getName(), $difficulty1, $O_recipe1->getDuration(), $averageGrade1, $O_recipe1->getId()];
        $recipe2 = [$O_recipe2->getImageUrl(), $O_recipe2->getName(), $difficulty2, $O_recipe2->getDuration(), $averageGrade2, $O_recipe2->getId()];
        $recipe3 = [$O_recipe3->getImageUrl(), $O_recipe3->getName(), $difficulty3, $O_recipe3->getDuration(), $averageGrade3, $O_recipe3->getId()];
        $array = [$recipe1, $recipe2, $recipe3];
        Vue::montrer('home/SlideShow', $array);
    }

    private function averageGrade($O_recipe)
    {
        $average = 0;
        $sum = 0;
        $appreciations = $O_recipe->getAppreciations();
        for ($i = 0; $i < sizeof($appreciations); ++$i) {
            $sum += $appreciations[$i]->getGrade();
        }
        $average = $sum / sizeof($appreciations);
        return $average;
    }

    private function difficulty($O_recipe)
    {
        $difficulty = $O_recipe->getDifficulty();
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
        Vue::montrer('standard/entete');
        Vue::montrer('standard/navbar');
        Vue::montrer('home/SearchResults', $array);
    }


    public function filterAction()
    {
        ini_set('display_errors', 0);
        $difficulty = $_POST['difficulty'];
        $name = $_POST['name'];
        $duration = $_POST['duration'];
        $filteredResults = [];
        $allResults = Search::searchByName($name);
        foreach ($allResults as $result) {
            $resultDifficulty = $this->difficulty($result);
            if ($resultDifficulty == $difficulty && $result->getName() == $name && $result->getDuration() >= $duration - 5 && $result->getDuration() <= $duration + 5) {
                $recipe = [$result->getImageUrl(), $result->getName(), $resultDifficulty, $result->getDuration(), $result->getId()];
                array_push($filteredResults, $recipe);
            } else if ($resultDifficulty == $difficulty && $result->getDuration() == $duration) {
                $recipe = [$result->getImageUrl(), $result->getName(), $resultDifficulty, $result->getDuration(), $result->getId()];
                array_push($filteredResults, $recipe);
            } else if ($result->getDuration() >= $duration - 5 && $result->getDuration() <= $duration + 5) {
                $recipe = [$result->getImageUrl(), $result->getName(), $resultDifficulty, $result->getDuration(), $result->getId()];
                array_push($filteredResults, $recipe);
            } else if ($resultDifficulty == $difficulty) {
                $recipe = [$result->getImageUrl(), $result->getName(), $resultDifficulty, $result->getDuration(), $result->getId()];
                array_push($filteredResults, $recipe);
            } else if (strpos(strtolower($result->getName()), strtolower($name)) !== false) {
                $recipe = [$result->getImageUrl(), $result->getName(), $resultDifficulty, $result->getDuration(), $result->getId()];
                array_push($filteredResults, $recipe);
            }
        }
        Vue::montrer('standard/entete');
        Vue::montrer('standard/navbar');
        Vue::montrer('home/SearchResults', $filteredResults);
    }

    public function registerAction()
    {
        Vue::montrer('standard/entete');
        Vue::montrer('standard/navbar');
        Vue::montrer('home/Register');
    }
    public function logInAction()
    {
        Vue::montrer('standard/entete');
        Vue::montrer('standard/navbar');
        Vue::montrer('home/LogIn');
    }
    public function profileAction()
    {
        Vue::montrer('standard/entete');
        Vue::montrer('standard/navbar');
        Vue::montrer('home/profile');
    }

    public function connexionAction()
    {
        session_start();
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $user = User::getByLogin($login);

            if ($user->getLogin() != $login) {
                echo "L'utilisateur n'existe pas";
            } else {
                if ($user->getHashedPassword() === $password) {
                    $_SESSION['user'] = $user;
                    echo "Connexion réussie";
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
                    Vue::montrer('standard/entete');
                    Vue::montrer('standard/navbar');

                    $averageGrade1 = $this->averageGrade($O_recipe1);
                    $averageGrade2 = $this->averageGrade($O_recipe2);
                    $averageGrade3 = $this->averageGrade($O_recipe3);
                    $difficulty1 = $this->difficulty($O_recipe1);
                    $difficulty2 = $this->difficulty($O_recipe2);
                    $difficulty3 = $this->difficulty($O_recipe3);
                    $recipe1 = [$O_recipe1->getImageUrl(), $O_recipe1->getName(), $difficulty1, $O_recipe1->getDuration(), $averageGrade1, $O_recipe1->getId()];
                    $recipe2 = [$O_recipe2->getImageUrl(), $O_recipe2->getName(), $difficulty2, $O_recipe2->getDuration(), $averageGrade2, $O_recipe2->getId()];
                    $recipe3 = [$O_recipe3->getImageUrl(), $O_recipe3->getName(), $difficulty3, $O_recipe3->getDuration(), $averageGrade3, $O_recipe3->getId()];
                    $array = [$recipe1, $recipe2, $recipe3];
                    Vue::montrer('home/SlideShow', $array);
                } else {
                    echo "Mot de passe incorrect";
                }
            }
        } else {
            echo "Veuillez remplir tous les champs";
        }
    }
}
