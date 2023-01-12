<?php
//TODO REFACTORE AVEC listIngredientView
echo '<p> Ingredient : </p> <ul>';
for($i = 0; $i < count($A_vue['recipe']); ++$i){
    echo '<li>'.$A_vue['recipe'][$i].'</li>'."\n";
}
echo '</ul>';