<?php
echo '<div class="selection_milleu">';
echo '<div class="les_listes">';
echo '<div class ="Ingredients">';
echo '<p><strong>Ingrédients :  </strong></p>';
echo '<ul class="la_liste_ingredients">';
for($i = 0; $i < count($A_vue['recipe']); ++$i){
    echo '<li>'.$A_vue['recipe'][$i].'</li>'."\n";
}
echo '</ul>';
echo '</div>';