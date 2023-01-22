<?php
echo '<div class="Bot_page">';
echo '<ol class="Recipe_explanation">';
for($i = 0; $i < count($A_vue[0]); ++$i){
    echo '<li>'.$A_vue[0][$i].'</li>'."\n";
}
echo '</ol>';
echo '<p class="author">'.$A_vue[1].'</p>';
echo '<p class="Cost">'.$A_vue[2].'</p>';
echo '</div>';