/*<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="Vues/Home/styleaccueil.css">
    <title>Site de Recette Patissiére</title>
    <meta charset="utf-8"/>
</head>
<body>
    <div class="barre_de_nav">
        <ul>
            <li class><a class="backgroundimage" href="Accueil.html">_ </a></li>
            <li style="float:middle"><textarea class="Recherche" name="Recherche"rows="2" cols="33" placeholder="Recherche..."></textarea></li>
            <li style="float:middle"><button class="Searchbutton" type="button"></button></li>
            <li style="float:right"><a href="#login">se connecter</a></li>
            <li style="float:right"><a class="active" href="#signin">s'enregistrer</a></li>
        </ul>
    </div>
    <div class="titre_recomandation">
        <h1 class="titre">Accueil </h1>
        <h2 class="titre_recette_rand">Recomantation</h2>
    </div>

<div class ="recette_random">
        <?php
            // Récupération des données des recettes aléatoires
            $sql = "SELECT ID_RECIPE, NAME, DESCRIPTION,IMAGE_URL,DURATION FROM RECIPE 
            ORDER BY RAND() LIMIT 3";
            $stmt = modele::$pdo->prepare($sql);
            $stmt->execute();
            $cakes = $stmt->fetchAll();

            // Affichage des recettes dans les divs respectives
            for ($i = 0; $i < 3; $i++) {
                echo "<div class='recette_" . ($i + 1) . "'>";
                echo "<img src='" . $cakes[$i]['IMAGE_URL'] . "' alt='" . $cakes[$i]['NAME'] . "' style='width: 300px; height: 190px;'"."/>";
                echo "<p class=small-text>" . $cakes[$i]['NAME'] . "</p>";
                echo "<p class=small-text>" . $cakes[$i]['DURATION'] ."\n"."Min". "</p>";
                echo "<p class=small-text>" . $cakes[$i]['DURATION'] ."\n"."Min". "</p>";
                //echo "<p class=small-text>" . $cakes[$i]['ID_DIFFICULTY'] . "</p>";

               // echo "<p>Note : " . $cakes[$i]['GRADE'] . "/5</p>";
                echo "</a>";
                echo "</div>";
            }
        ?>
    </div>

    <div class="cathegorie">
        <div class="Ingrédient">
            <p>Ingrédients : </p>
            <textarea class="textareaIngrédient" name="textareaIngrédient"rows="5" cols="33" placeholder="Ingrédients"></textarea>
        </div>
        <div class="Ustensile">
            <p>Ustensiles : </p>
            <textarea class="textareaUstensile" name="story"rows="5" cols="33" placeholder="Ustensiles"></textarea>
        </div>
        <div class="temps_de_préparation">
            <p>Temps de Préparation : </p>
            <textarea class="textareaTemps_de_préparation" name="story"rows="5" cols="33" placeholder="temps_de_préparation"></textarea>
        </div>
        <div class="type_de_cuisson">
            <p>Type de Cuisson : </p>
            <textarea class="textareaType_de_cuisson" name="story"rows="5" cols="33" placeholder="type_de_cuisson"></textarea>
        </div>
        <div class="Difficulté">
            <p>Difficulté : </p>
            <div class="les_button_difficulté">
                <button class="button_très_facile"type="button">Très Facile</button>
                <button class="button_facile"type="button">Facile</button>
                <button class="button_moyen"type="button">Moyen</button>
                <button class="button_difficile"type="button">Difficile</button>
            </div>
        </div>
        <div class="Coût">
            <p>Coût : </p>
            <div class="les_button_cout">
                <button class="button_bon_marché"type="button">Bon Marché</button>
                <button class="button_coût_moyen"type="button">Coût Moyen</button>
                <button class="button_assez_chère"type="button">Assez Chère</button>
            </div>
        </div>
        <div class="Particularité">
            <p>Particularité : </p>
            <div class="les_button_particularité">
                <button class="végétarien"type="button">Végétarien</button>
                <button class="végan"type="button">Végan</button>
                <button class="sans_gluten"type="button">Sans Gluten</button>
                <button class="sans_lactose"type="button">Sans Lactose</button>
            </div>
        </div>
    </div>
</body>
</html>