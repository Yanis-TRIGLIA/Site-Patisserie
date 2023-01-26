<?php
echo '<form  method="post" name="EditView" action="../update/'.$A_vue->getId().'">';
echo '<div class="Top_page">';
echo '<h1 class=title_page_recette> Name : <textarea name="name">'.$A_vue->getName().'</textarea></h1>';
echo '<p class="Difficult"> Difficulté : <select name="difficult">
<option value="1">Facile</option>
<option value="2">Moyen</option>
<option value="3">Difficile</option>
</select></p>';
echo '<p class="time"> temps : <textarea name="time">'.$A_vue->getDuration().'</textarea> min </p>';
echo '</div>'; 
echo '<div class="Mid_page">';
echo '<div class="Mid_page_lists">';
echo '<div class ="Ingredients">';
echo '<p><strong>Ingrédients :  </strong></p>';
echo '<ul class="Ingredients_list">';
$i = 0;
$arrayIngredient = [];
foreach ($A_vue->getIngredients() as $ingredientRecipe){
    array_push($arrayIngredient,$ingredientRecipe->getIngredient());
}
foreach (Ingredient::getAll() as $ingredient)
{
    if(in_array($ingredient,$arrayIngredient))
        echo '<li><input type="checkbox" id="'.$i.'" name="ingredient_name'.$i.'" value="'.$ingredient.'" checked><label for="'.$i.'">'.$ingredient->getName().'</label><br> Quantité : <textarea name="quantity'.$i.'"></textarea></li>';
    else
        echo '<li><input type="checkbox" id="'.$i.'" name="ingredient_name'.$i.'" value="'.$ingredient.'"><label for="'.$i.'">'.$ingredient->getName().'</label><br> Quantité : <textarea name="quantity'.$i.'"></textarea></li>';
    ++$i;
}
echo '</ul>';
echo '</div>';
echo '<div classe="Utensils">';
echo '<p><strong>Ustensiles :</strong></p>';
echo '<ul class="Utensils_list">';
$j = 0;
$arrayUstensils = [];
foreach ($A_vue->getUstensils() as $ustensil){
    array_push($arrayUstensils, $ustensil->getId());
}
foreach (Ustensil::getAll() as $ustensil)
{
    if(in_array($ustensil->getId(), $arrayUstensils))
        echo '<li><input type="checkbox" id="'.$j.'" name="ustensil'.$j.'" value="'.$ustensil.'" checked><label for="'.$j.'">'.$ustensil->getName().'</label></li>';
    else
        echo '<li><input type="checkbox" id="'.$j.'" name="ustensil'.$j.'" value="'.$ustensil.'"><label for="'.$j.'">'.$ustensil->getName().'</label></li>';
    ++$j;
}
echo '</ul>';
echo '</div>';
echo '</div>';
echo '<div class="pancake_picture">';
echo '<img class="king_pancake" src="" alt=" "/>';
echo 'url <textarea name="url">'.$A_vue->getImageUrl().'</textarea>';
echo '</div>';
echo '</div>';
echo '<div class="Bot_page">';
echo '<ol class="Recipe_explanation">';
$stringDescription = '';
foreach ($A_vue->getDescription() as $description)
{
 $stringDescription = $stringDescription.$description.' ';
}
echo '<li>description de la recette <textarea name="description">'.$stringDescription.'</textarea></li>';
echo '</ol>';
echo '<p class="Cost"> Coût : <select name="cost">
<option value="1">bon marché</option>
<option value="2">coût moyen</option>
<option value="3">assez cher</option>
</select></p>';
echo '</div>';
echo '<input type="submit" value="Submit" >';
echo '</form>';