<?php
echo '<p>'.$A_vue['recipe'][0].':  </p> <ul>';
for($i = 1; $i < count($A_vue['recipe']); ++$i){
    echo '<li>'.$A_vue['recipe'][$i].'</li>'."\n";
}
echo '</ul>';