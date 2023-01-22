<?php 
echo '<div class="Navigation_bar">';
echo '<form method="post" action="home/search">';
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