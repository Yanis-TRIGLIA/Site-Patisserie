<?php
for($i= 0; $i < sizeof($A_vue);++$i){
    echo '<div class="Comments">';
    echo '<img class="Profil_picture_com" src='.$A_vue[$i]->getAuthor()->getPpUrl().' alt="Photo_de_profil_com"/>';
    echo '<p class="Username"><strong> '.$A_vue[$i]->getAuthor()->getName().'</strong></p>';
    echo '<div class="My_comment">';
    echo '<p class="title_com"><strong>'.$A_vue[$i]->getName().'</strong></p>';
    echo '<p class="message_com1">'.$A_vue[$i]->getCommentary().'</p>';
    echo '<p class="note_com1">Note : '.$A_vue[$i]->getGrade().'</p>';
    echo '</div>';
    echo '<p class="date_publication"><strong>'.$A_vue[$i]->getDate().'</strong></p>';
    echo '</div>';
}