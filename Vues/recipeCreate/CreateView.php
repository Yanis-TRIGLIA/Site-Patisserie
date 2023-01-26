<?php
echo '<form  method="post" name="CreateView" action="insert">';
echo '<div class="Top_page">';
echo '<h1 class=title_page_recette> Name : <textarea name="name"> </textarea></h1>';
echo '<p class="Difficult"> Difficulté : <select name="difficult">
<option value="1">Facile</option>
<option value="2">Moyen</option>
<option value="3">Difficile</option>
</select></p>';
echo '<p class="time"> temps : <textarea name="time"></textarea> min </p>';
echo '</div>'; 
echo '<div class="Mid_page">';
echo '<div class="Mid_page_lists">';
echo '<div class ="Ingredients">';
echo '<p><strong>Ingrédients :  </strong></p>';
echo '<ul class="Ingredients_list">';
$i = 0;
foreach ($A_vue[0] as $ingredient)
{
    echo '<li><input type="checkbox" id="'.$i.'" name="ingredient_name'.$i.'" value="'.$ingredient.'"><label for="'.$i.'">'.$ingredient->getName().'</label><br> Quantité : <textarea name="quantity'.$i.'"></textarea></li>';
    ++$i;
}
//echo '<li><textarea name="ingredients"></textarea></li>';
echo '</ul>';
echo '</div>';
echo '<div classe="Utensils">';
echo '<p><strong>Ustensiles :</strong></p>';
echo '<ul class="Utensils_list">';
$j = 0;
foreach ($A_vue[1] as $ustensil)
{
    echo '<li><input type="checkbox" id="'.$j.'" name="ustensil'.$j.'" value="'.$ustensil.'"><label for="'.$j.'">'.$ustensil->getName().'</label></li>';
    ++$j;
}
//echo '<li><textarea name="ustensils"></textarea></li>';
echo '</ul>';
echo '</div>';
echo '</div>';
echo '<div class="pancake_picture">';
echo '<img class="king_pancake" src="" alt=" "/>';
echo 'url <textarea name="url"></textarea>';
echo '</div>';
echo '</div>';
echo '<div class="Bot_page">';
echo '<ol class="Recipe_explanation">';
echo '<li>description de la recette <textarea name="description"></textarea></li>'."\n";
echo '</ol>';
echo '<p class="Cost"> Coût : <select name="cost">
<option value="1">bon marché</option>
<option value="2">coût moyen</option>
<option value="3">assez cher</option>
</select></p>';
echo '</div>';
echo '<input type="submit" value="Submit" >';
echo '</form>';