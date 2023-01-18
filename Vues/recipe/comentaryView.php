<?php
for($i= 0; sizeof($A_vue);++$i){
    echo '<div class="Com">';
    echo '<img class="Photo_de_profil_com" src="/image/galette_des_rois.jpeg" alt="Photo_de_profil_com"/>';
    echo '<div class="Mes_not_com">';
    echo '<p class="message_com1">'.$A_vue[$i]->getCommentary().'</p>';
    echo '<p class="note_com1">Note:'.$A_vue[$i]->getGrade().'</p>';
    echo '</div>';
    echo '</div>';
}

