<?php
echo '<head>';
echo '<link rel="stylesheet" href="/Css/stylesite.css">';
echo '</head>';
echo '<div class="container">';
echo '<form class="login_form" method="POST" action="/home/connexion">';
echo '<p>Connectez Vous!</p>';
echo '<input class="write" name="login" placeholder="Login">';
echo '<br>';
echo '<br>';
echo '<input type="password" class="write" name="password" placeholder="Mot de Passe">';
echo '<br>';
echo '<br>';
echo '<button class="write" value="" type="submit">Connexion</button>';
echo '</form>';
echo '</div>';
