<?php
//TODO REFACTORE AVEC listUstensileView
echo '<div classe="Ustensiles">';
echo '<p><strong>Ustensiles :</strong></p>';
echo '<ul class="la_liste_ustensiles">';
for($i = 0; $i < count($A_vue['recipe']); ++$i){
    echo '<li>'.$A_vue['recipe'][$i].'</li>'."\n";
}
echo '</ul>';
echo '</div>';
echo '</div>';