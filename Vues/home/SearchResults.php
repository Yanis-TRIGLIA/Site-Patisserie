<?php
 echo '<link rel="stylesheet" href="/Css/stylesite.css">';
echo '<div class= "Search_Results">';
if($A_vue == null){
    echo '<h2 class="moment_title">Aucun résultat</h2>';
}
else{
    echo '<h2 class="moment_title">Résultats de la recherche :</h2>';
}
foreach($A_vue as $vue){
    echo '<div class= "Result_recipe">';
    echo  "<a href='/recipe/edit/" . $vue[4] . "'>";
    echo '<img class="Picture_result_recipe" src='.$vue[0].' alt="'.$vue[1].'"/>';
    echo "<p class=small-text>" ."Nom :". $vue[1] . "</p>";
    echo "<p class=small-text>" . "Difficulter :".$vue[2] . "</p>";
    echo "<p class=small-text>" ."Durée :". $vue[3]. "\n"."Min"."</p>";
    echo '</a>';
    echo '</div>';
}
echo '</div>';
