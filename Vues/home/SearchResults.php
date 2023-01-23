<?php
echo '<link rel="stylesheet" href="/Css/stylesite.css">';
echo '<div class="Navigation_bar">';
echo '<form method="post" action="home/search" class="Navigation_bar">';
echo '<ul>';
echo '<li class><a class="backgroundimage" href="https://tpphp1.alwaysdata.net/home">_ </a></li>';
echo '<li style="float:middle">';
echo '<input class="Search" type="text" name="query" placeholder="Recherche...">';
echo '</li>';
echo '<li style="float:middle">';
echo '<button class="Searchbutton" type="submit"></button>';
echo '</li>';
echo '<li style="float:right"><a class="login" href="#login">se connecter</a></li>';
echo '<li style="float:right"><a class="sigin" href="#signin">s\'enregistrer</a></li>';
echo '</ul>';
echo '</form>';
echo '</div>';
echo '<br>';
echo '<br>';
echo '<button id="filter-button" onclick="showFilters()">Filtres</button>';
echo '<div id="filter-options" style="display: none;">';
echo '<form method="post" action="/home/filter">';
echo '<label for="name">Nom :</label>';
echo '<input type="text" name="name" placeholder="Rechercher une recette">';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<label for="difficulty">Difficulté :</label>';
echo '<select name="difficulty" id="difficulty">';
echo '<option value=Facile>Facile</option>';
echo '<option value=Moyen>Moyen</option>';
echo '<option value=Difficile>Difficile</option>';
echo '</select>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<label for="duration">Durée :</label>';
echo '<input type="text" name="duration" id="duration" placeholder="en minutes">';
echo '<br>';
echo '<br>';
echo '<button class="Filtrer" type="submit">Filtrer</button>';
echo '</form>';
echo '</div>';
 ?>
 <script>
   function showFilters() {
     var filterOptions = document.getElementById("filter-options");
     if (filterOptions.style.display === "none") {
       filterOptions.style.display = "block";
     } else {
       filterOptions.style.display = "none";
     }
   }
 </script>
 <?php
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
