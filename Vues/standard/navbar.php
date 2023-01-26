<?php
if (isset($_SESSION['user'])) {
    // L'utilisateur est connecté
    echo
    '<div class="Navigation_bar">
    <link rel="stylesheet" href="/Css/stylesite.css">
    <form method="post" action="/home/search" class="Navigation_bar">
    <ul>
    <li class><a class="backgroundimage" href="https://tpphp1.alwaysdata.net">_ </a></li>
    <li style="float:middle">
    <input class="Search" type="text" name="query" placeholder="Recherche...">
    </li>
    <li style="float:middle">
    <button class="Searchbutton" type="submit"></button>
    </li>

    <li style="float:right">
    <a href="/home/logout" class="link_profile" style="padding-top: 8px">
    <img class="logout_button" src="https://cdn-icons-png.flaticon.com/512/126/126467.png" width="50" height="50" ">
    </a>
    </li>
    
    <li style="float:right">
    <a href="/home/profile" class="link_profile" style="padding-top: 8px">
    <img class="profil_button" src="https://cdn-icons-png.flaticon.com/512/25/25634.png" width="50" height="50" ">
    </a>
    </li>
    
    
    </ul>
    </form>
    </div>';
} else {
    // L'utilisateur n'est pas connecté
    echo '<div class="Navigation_bar">';
    echo '<form method="post" action="/home/search" class="Navigation_bar">';
    echo '<ul>';
    echo '<li class><a class="backgroundimage" href="https://tpphp1.alwaysdata.net/home">_ </a></li>';
    echo '<li style="float:middle">';
    echo '<input class="Search" type="text" name="query" placeholder="Recherche...">';
    echo '</li>';
    echo '<li style="float:middle">';
    echo '<button class="Searchbutton" type="submit"></button>';
    echo '</li>';
    echo '<li style="float:right"><a class="login" href="/home/logIn">se connecter</a></li>';
    echo '<li style="float:right"><a class="sigin" href="/home/register">s\'enregistrer</a></li>';
    echo '</ul>';
    echo '</form>';
    echo '</div>';
}
