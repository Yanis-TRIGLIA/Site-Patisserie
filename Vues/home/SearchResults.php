<?php
echo'<button id="filter-button" onclick="showFilters()">Filtres</button>
<div id="filter-options" style="display: none;">
<form method="post" action="/home/filter">
<label for="name">Nom :</label>
<input type="text" name="name" placeholder="Rechercher une recette">
<br>
<br>
<br>
<label for="difficulty">Difficulté :</label>
<select name="difficulty" id="difficulty">
<option value=Choix>Veuillez Choisir Votre Difficulter</option>
<option value=Facile>Facile</option>
<option value=Moyen>Moyen</option>
<option value=Difficile>Difficile</option>
</select>
<br>
<br>
<br>
<label for="duration">Durée :</label>
<input type="number" name="duration" id="duration" value="0" >
<br>
<br>
<button class="Filtrer" type="submit">Filtrer</button>
</form>
 </div>';
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
    echo  "<a href='/recipe/defaut/" . $vue[4] . "'>";
    echo '<img class="Picture_result_recipe" src='.$vue[0].' alt="'.$vue[1].'"/>';
    echo "<p class=small-text>" ."Nom :". $vue[1] . "</p>";
    echo "<p class=small-text>" . "Difficulter :".$vue[2] . "</p>";
    echo "<p class=small-text>" ."Durée :". $vue[3]. "\n"."Min"."</p>";
    echo '</a>';
    echo '</div>';
}
echo '</div>';