<?php
echo '<form  method="post" name="EditView" action="../update/'.$A_vue->getId().'">';
echo '<div class="Top_page">';
echo '<h1 class=title_page_recette> Name : <textarea class="recipe_edit_name" name="name" row="1">'.$A_vue->getName().'</textarea></h1>';
echo '<p> Difficulté : <select class="recipe_edit_Difficult" name="difficult">
<option value="1">Facile</option>
<option value="2">Moyen</option>
<option value="3">Difficile</option>
</select></p>';
echo '<p> temps : <textarea class="recipe_edit_time" name="time">'.$A_vue->getDuration().'</textarea> min </p>';
echo '</div>'; 
echo '<div class="Mid_page">';
echo '<div class="Mid_page_lists">';
echo '<div class ="Ingredients">';
echo '<p><strong>Ingrédients :  </strong></p>';
echo '<ul class="recipe_edit_Ingredients_list">';
$i = 0;
$arrayIngredient = [];
foreach ($A_vue->getIngredients() as $ingredientRecipe){
    array_push($arrayIngredient,$ingredientRecipe->getIngredient());
}
foreach (Ingredient::getAll() as $ingredient)
{
    if(in_array($ingredient,$arrayIngredient))
        echo '<li><input class="recipe_edit_Utensils_list_checkbox" type="checkbox" id="'.$i.'" name="ingredient_name'.$i.'" value="'.$ingredient.'" checked><label for="'.$i.'"></label><br> <textarea class="recipe_edit_ingredients" rows="1" cols="1" placeholder="Quantité de '.$ingredient->getName().' : " name="quantity'.$i.'"></textarea></li>';
    else
        echo '<li><input class="recipe_edit_Utensils_list_checkbox" type="checkbox" id="'.$i.'" name="ingredient_name'.$i.'" value="'.$ingredient.'"><label for="'.$i.'"></label><br> <textarea class="recipe_edit_ingredients" rows="1" cols="1" placeholder="Quantité de '.$ingredient->getName().' : " name="quantity'.$i.'"></textarea></li>';
    ++$i;
}
echo '</ul>';
echo '</div>';
echo '<div classe="Utensils">';
echo '<p><strong>Ustensiles :</strong></p>';
echo '<ul class="recipe_edit_Utensils_list">';
$j = 0;
$arrayUstensils = [];
foreach ($A_vue->getUstensils() as $ustensil){
    array_push($arrayUstensils, $ustensil->getId());
}
foreach (Ustensil::getAll() as $ustensil)
{
    if(in_array($ustensil->getId(), $arrayUstensils))
        echo '<li><input type="checkbox" class="recipe_edit_Ustensils_list_checkbox"id="'.$j.'" name="ustensil'.$j.'" value="'.$ustensil.'" checked><label  class="recipe_edit_Utensils_list_label" for="'.$j.'">'.$ustensil->getName().'</label></li>';
    else
        echo '<li><input type="checkbox" class="recipe_edit_Ustensils_list_checkbox"id="'.$j.'" name="ustensil'.$j.'" value="'.$ustensil.'"><label class="recipe_edit_Utensils_list_label"  for="'.$j.'">'.$ustensil->getName().'</label></li>';
    ++$j;
}
echo '</ul>';
echo '</div>';
echo '</div>';
echo '<textarea class="recipe_edit_url" name="url" placeholder="Url de l\'image :">'.$A_vue->getImageUrl().'</textarea>';
echo '</div>';
echo '<div class="Bot_page">';
echo '<ol class="Recipe_explanation">';
$stringDescription = '';
foreach ($A_vue->getDescription() as $description)
{
 $stringDescription = $stringDescription.$description.' ';
}
echo '<li><textarea class= "recipe_edit_description" name="description"placeholder="Description de la recette">'.$stringDescription.'</textarea></li>';
echo '</ol>';
echo '<p> Coût : <select class="recipe_edit_Cost" name="cost">
<option value="1">bon marché</option>
<option value="2">coût moyen</option>
<option value="3">assez cher</option>
</select></p>';
echo '</div>';
echo '<input type="submit"class= "recipe_edit_submit" value="Envoyer" >';
echo '</form>';