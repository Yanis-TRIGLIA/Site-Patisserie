<?php
session_start();

final class ControleurRecipe
{
    public function defautAction($A_urlParams)
    {
        $id = ($A_urlParams[0]);
        $O_recipe = Recipe::getById($id);
        Vue::montrer('standard/navbar');

        $averageGrade = $this->averageGrade($O_recipe);
        $mainInfo = [$O_recipe->getName(), $O_recipe->getDifficulty()->getName(), $O_recipe->getDuration(), $averageGrade];
        Vue::montrer('recipe/mainInfoView', $mainInfo);

        Vue::montrer('recipe/listIngredientView', array('recipe' => $O_recipe->getIngredients()));
        Vue::montrer('recipe/listUstensileView', array('recipe' => $O_recipe->getUstensils()));
        Vue::montrer('recipe/imageView', [$O_recipe->getImageUrl(), $O_recipe->getName()]);

        $textInfo = [$O_recipe->getDescription(), $O_recipe->getAuthor()->getName(), $O_recipe->getCost()->getName()];
        Vue::montrer('recipe/textView', $textInfo);

        Vue::montrer('recipe/comentaryView', $O_recipe->getAppreciations());
        Vue::montrer('recipe/formView');
    }

    public function editAction($A_urlParams)
    {
        $id = ($A_urlParams[0]);
        $O_recipe = Recipe::getById($id);
        Vue::montrer('standard/navbar');
        Vue::montrer('recipeEdit/EditView', $O_recipe);
    }


    public function createAction()
    {

        $O_ustensil = Ustensil::getAll();
        $O_ingredient = Ingredient::getAll();
        Vue::montrer('standard/navbar');
        Vue::montrer('recipeCreate/CreateView', [$O_ingredient, $O_ustensil]);
    }

    public function insertAction()
    {
        $O_ustensil = Ustensil::getAll();
        $arrayUstensil = [];
        for ($i = 0; $i < sizeof($O_ustensil); ++$i) {
            if (!$_POST['ustensil' . $i] == null)
                array_push($arrayUstensil, $O_ustensil[$i]);
        }

        $arrayIngredient = [];
        $O_ingredient = Ingredient::getAll();
        for ($i = 0; $i < sizeof($O_ustensil); ++$i) {
            if (!$_POST['ingredient_name' . $i] == null)
                array_push($arrayIngredient, new IngredientRecipe($O_ingredient[$i], $_POST['quantity' . $i]));
        }

        //TODO : replace User::getById(1) by $_SESSION['user']
        $O_recipe = new Recipe(null, $_POST['name'], array($_POST['description']), $_POST['time'], User::getById(1),
        Difficulty::getById(intval($_POST['difficult'])), Cost::getById(intval($_POST['cost'])),
        $arrayUstensil, $arrayIngredient, null, $_POST['url']);
        $O_recipe->insert();
        Vue::montrer('standard/redirectingView',$O_recipe->getId());
    }

    public function updateAction($A_urlParams){
        $id = ($A_urlParams[0]);
        $O_ustensil = Ustensil::getAll();
        $arrayUstensil = [];
        for ($i = 0; $i < sizeof($O_ustensil); ++$i) {
            if (!$_POST['ustensil' . $i] == null)
                array_push($arrayUstensil, $O_ustensil[$i]);
        }

        $arrayIngredient = [];
        $O_ingredient = Ingredient::getAll();
        for ($i = 0; $i < sizeof($O_ustensil); ++$i) {
            if (!$_POST['ingredient_name' . $i] == null)
                array_push($arrayIngredient, new IngredientRecipe($O_ingredient[$i], $_POST['quantity' . $i]));
        }

        //TODO : replace User::getById(1) by $_SESSION['user']
        $O_recipe = new Recipe($id, $_POST['name'], array($_POST['description']), $_POST['time'], User::getById(1),
        Difficulty::getById(intval($_POST['difficult'])), Cost::getById(intval($_POST['cost'])),
        $arrayUstensil, $arrayIngredient, null, $_POST['url']);

        $O_recipe->update();
        Vue::montrer('standard/redirectingView',$O_recipe->getId());
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
}
