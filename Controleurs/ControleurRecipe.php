<?php

final class ControleurRecipe
{
    public function defautAction($A_urlParams)
    {
        $id = ($A_urlParams[0]);
        $O_recipe = Recipe::getById($id);
        Vue::montrer('standard/navbar');

        $averageGrade = $this->averageGrade($O_recipe);
        $mainInfo = [$O_recipe->getName(),$O_recipe->getDifficulty()->getName(),$O_recipe->getDuration(),$averageGrade];
        Vue::montrer('recipe/mainInfoView', $mainInfo);
        
        Vue::montrer('recipe/listIngredientView', array('recipe' => $O_recipe->getIngredients()));
        Vue::montrer('recipe/listUstensileView', array('recipe' => $O_recipe->getUstensils()));
        Vue::montrer('recipe/imageView', [$O_recipe->getImageUrl(),$O_recipe->getName()]);

        $textInfo = [$O_recipe->getDescription(),$O_recipe->getAuthor()->getName(),$O_recipe->getCost()->getName()];
        Vue::montrer('recipe/textView', $textInfo);

        Vue::montrer('recipe/comentaryView', $O_recipe->getAppreciations());
        Vue::montrer('recipe/formView');

    }

    public function editAction($A_urlParams,$id)
    {
        $id = ($A_urlParams[0]);
        $O_recipe = Recipe::getById($id);
        Vue::montrer('standard/navbar');

        $averageGrade = $this->averageGrade($O_recipe);
        $mainInfo = [$O_recipe->getName(),$O_recipe->getDifficulty()->getName(),$O_recipe->getDuration(),$averageGrade];
        Vue::montrer('recipe/mainInfoView', $mainInfo);
        
        Vue::montrer('recipe/listIngredientView', array('recipe' => $O_recipe->getIngredients()));
        Vue::montrer('recipe/listUstensileView', array('recipe' => $O_recipe->getUstensils()));
        Vue::montrer('recipe/imageView', [$O_recipe->getImageUrl(),$O_recipe->getName()]);

        $textInfo = [$O_recipe->getDescription(),$O_recipe->getAuthor()->getName(),$O_recipe->getCost()->getName()];
        Vue::montrer('recipe/textView', $textInfo);

        Vue::montrer('recipe/comentaryView', $O_recipe->getAppreciations());
        Vue::montrer('recipe/formView');
    }
   
    private function averageGrade($O_recipe)
    {
        $average = 0;
        $sum = 0;
        $appreciations = $O_recipe->getAppreciations();
        for ($i=0; $i<sizeof($appreciations);++$i){
            $sum += $appreciations[$i]->getGrade();
        }
        $average = $sum/sizeof($appreciations);
        return $average;
    }

}