<?php

final class ControleurRecipe
{
    public function defautAction()
    {
        $O_recipe = Recipe::getById(1);
        Vue::montrer('standard/entete', array('recipe'=> $O_recipe->getName()));
        Vue::montrer('standard/navbar');

        $averageGrade = $this->averageGrade($O_recipe);
        $mainInfo = [$O_recipe->getName(),$O_recipe->getDifficulty()->getName(),$O_recipe->getDuration(),$averageGrade];
        Vue::montrer('recipe/mainInfoView', $mainInfo);
        
        Vue::montrer('recipe/listIngredientView', array('recipe' => $O_recipe->getIngredients()));
        Vue::montrer('recipe/listUstensileView', array('recipe' => $O_recipe->getUstensils()));
        Vue::montrer('recipe/imageView', [$O_recipe->getImageUrl(),$O_recipe->getName()]);

        $textInfo = [$O_recipe->getDescription(),$O_recipe->getAuthor()->getDisplayName(),$O_recipe->getCost()->getName()];
        Vue::montrer('recipe/textView', $textInfo);

        Vue::montrer('recipe/comentaryView', $O_recipe->getAppreciations());
        Vue::montrer('recipe/formView');
        Vue::montrer('standard/pied');
    }
   
   /*just for the test
   public function editAction()
   {
       $O_recipe =  new Recipe();

       Vue::montrer('standard/entete', array('recipe'=> $O_recipe->donneMessage()));
       Vue::montrer('standard/navbar');
       Vue::montrer('recipe/mainInfoView', array('recipe' => $O_recipe->donneMessage1()));
       Vue::montrer('recipe/listIngredientView', array('recipe' => $O_recipe->donneMessage2()));
       Vue::montrer('recipe/listUstensileView', array('recipe' => $O_recipe->donneMessage3()));
       Vue::montrer('recipe/imageView', array('recipe' => $O_recipe->donneMessage4()));
       Vue::montrer('recipe/textView', array('recipe' => $O_recipe->donneMessage5()));
       Vue::montrer('recipe/comentaryView', array('recipe' => $O_recipe->donneMessage6()));
       Vue::montrer('standard/pied');
    }*/

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