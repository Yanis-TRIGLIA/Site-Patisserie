<?php
echo '<div classe="Utensils">';
echo '<p><strong>Ustensiles :</strong></p>';
echo '<ul class="Utensils_list">';
for($i = 0; $i < count($A_vue['recipe']); ++$i){
    echo '<li>'.$A_vue['recipe'][$i]->getName().'</li>'."\n";
}
echo '</ul>';
echo '</div>';
echo '</div>';