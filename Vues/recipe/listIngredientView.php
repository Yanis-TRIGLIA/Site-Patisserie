<?php
echo '<div class="Mid_page">';
echo '<div class="Mid_page_lists">';
echo '<div class ="Ingredients">';
echo '<p><strong>Ingrédients :  </strong></p>';
echo '<ul class="Ingredients_list">';
for($i = 0; $i < count($A_vue['recipe']); ++$i){
    echo '<li>'.$A_vue['recipe'][$i]->getIngredient()->getName().' : '.$A_vue['recipe'][$i]->getQuantity().' '.$A_vue['recipe'][$i]->getIngredient()->getUnit().'</li>'."\n";
}
echo '</ul>';
echo '</div>';