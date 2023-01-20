<?php
echo '<div class="selection_basse">';
echo '<ol class="explication">';
for($i = 0; $i < count($A_vue[0]); ++$i){
    echo '<li>'.$A_vue[0][$i].'</li>'."\n";
}
echo '</ol>';
echo '<p class="auteur">'.$A_vue[1].'</p>';
echo '<p class="Coûte">'.$A_vue[2].'</p>';
echo '</div>';