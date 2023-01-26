<?php
echo '<form  method="post" name="CreateView" action="insert">';
echo '<div class="Top_page">';
echo '<h1 class=title_page_recette> Name : <textarea class="recipe_create_name" name="name" row="1"> </textarea></h1>';
echo '<p > Difficulté : <select class="recipe_create_Difficult" name="difficult">
<option value="1">Facile</option>
<option value="2">Moyen</option>
<option value="3">Difficile</option>
</select></p>';
echo '<p > temps : <textarea class="recipe_create_time" name="time"></textarea> min </p>';
echo '</div>'; 
echo '<div class="Mid_page">';
echo '<div class="Mid_page_lists">';
echo '<div class ="Ingredients">';
echo '<p><strong>Ingrédients :  </strong></p>';
echo '<ul class="recipe_create_Ingredients_list">';
$i = 0;
foreach ($A_vue[0] as $ingredient)
{
    echo '<li><input type="checkbox" id="'.$i.'" name="ingredient_name'.$i.'" value="'.$ingredient.'"><label for="'.$i.'"></label><br> <textarea class =" recipe_create_ingredients" name="quantity'.$i.'" rows="1" cols="1" placeholder="Quantité de '.$ingredient->getName().' : "></textarea></li>';
    ++$i;
}
//echo '<li><textarea name="ingredients"></textarea></li>';
echo '</ul>';
echo '</div>';
echo '<div classe="Utensils">';
echo '<p><strong>Ustensiles :</strong></p>';
echo '<ul class="recipe_create_Utensils_list">';
$j = 0;
foreach ($A_vue[1] as $ustensil)
{
    echo '<li ><input class="recipe_create_Utensils_list_checkbox"type="checkbox" id="'.$j.'" name="ustensil'.$j.'" value="'.$ustensil.'"><label class="recipe_create_Utensils_list_label" for="'.$j.'">'.$ustensil->getName().'</label></li>';
    ++$j;
}
//echo '<li><textarea name="ustensils"></textarea></li>';
echo '</ul>';
echo '</div>';
echo '</div>';
echo '<textarea class="recipe_create_url" name="url" placeholder="Url de l\'image :"></textarea>';
echo '</div>';
echo '<div class="Bot_page">';
echo '<p class="Recipe_explanation">';
echo '<textarea class= "recipe_create_description"name="description" placeholder="Description de la recette"></textarea>'."\n";
echo '</p>';
echo '<p > Coût : <select class="recipe_create_Cost" name="cost">
<option value="1">bon marché</option>
<option value="2">coût moyen</option>
<option value="3">assez cher</option>
</select></p>';
echo '</div>';
echo '<input class= "recipe_create_submit" type="submit" value="Envoyer" >';
echo '</form>';