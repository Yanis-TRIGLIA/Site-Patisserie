<?php
for($i= 0; $i < sizeof($A_vue);++$i){
    echo '<div class="Com">';
    echo '<img class="Photo_de_profil_com" src='.$A_vue[$i]->getAuthor()->getPpUrl().' alt="Photo_de_profil_com"/>';
    echo '<p class="Nom_utilisateur"><strong>'.$A_vue[$i]->getAuthor()->getDisplayName().'</strong></p>';
    echo '<div class="Mes_not_com">';
    echo '<p class="message_com1">'.$A_vue[$i]->getCommentary().'</p>';
    echo '<p class="note_com1">Note:'.$A_vue[$i]->getGrade().'</p>';
    echo '</div>';
    echo '</div>';
}

