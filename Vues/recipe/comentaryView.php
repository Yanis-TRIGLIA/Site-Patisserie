<?php
 echo '<div class="Com">';
 echo '<img class="Photo_de_profil_com" src="/image/galette_des_rois.jpeg" alt="Photo_de_profil_com"/>';
 echo '<div class="Mes_not_com">';
 echo '<p class="message_com1">'.$A_vue['recipe'][0].'</p>';
 echo '<p class="note_com1">Note:'.$A_vue['recipe'][1].'</p>';
 echo '</div>';
 echo '</div>';
 echo '<form id="form">';
 echo '<p>';
 echo '<label for="Note">Note </label>';
 echo '<input id="note" type="text" name="nom" value=" "/><br/>';
 echo '<textarea name="impression" rows="2" cols="50">';
 echo 'ceci est un une zone de commantaire';
 echo '</textarea><br/>';
 echo '<input type="submit" value="Enregistrer"/>';
 echo '</p>';
 echo '</form>';