<?php
echo '<link rel="stylesheet" href="/Css/styleaccueil.css">';
echo '<div class= "recette_random">';
echo '<div class= "recette_1">';
echo  "<a href='recipe/edit/" . $A_vue[0][5] . "'>";
echo '<img class="galette_des_rois" src='.$A_vue[0][0].' alt="'.$A_vue[1].'"/>';
echo "<p class=small-text>" ."Nom :". $A_vue[0][1] . "</p>";
echo "<p class=small-text>" . "Difficulter :".$A_vue[0][2] . "</p>";
echo "<p class=small-text>" ."Durée :". $A_vue[0][3]. "\n"."Min"."</p>";
echo '</a>';
echo '</div>';
echo '<div class= "recette_2">';
echo  "<a href='recipe/edit/" . $A_vue[1][5] . "'>";
echo '<img class="galette_des_rois" src='.$A_vue[1][0].' alt="'.$A_vue[1].'"/>';
echo "<p class=small-text>" ."Nom :". $A_vue[1][1] . "</p>";
echo "<p class=small-text>" . "Difficulter :".$A_vue[1][2] . "</p>";
echo "<p class=small-text>" ."Durée :". $A_vue[1][3]. "\n"."Min"."</p>";
echo '</a>';
echo '</div>';
echo '<div class= "recette_3">';
echo  "<a href='recipe/edit/" . $A_vue[2][5] . "'>";
echo '<img class="galette_des_rois" src='.$A_vue[2][0].' alt="'.$A_vue[1].'"/>';
echo "<p class=small-text>" ."Nom :". $A_vue[2][1] . "</p>";
echo "<p class=small-text>" . "Difficulter :".$A_vue[2][2] . "</p>";
echo "<p class=small-text>" ."Durée :". $A_vue[2][3]. "\n"."Min"."</p>";
echo '</a>';
echo '</div>';
echo '</div>';

  //echo "<a href='recipe/edit/" . $cake['ID_RECIPE'] . "'>";