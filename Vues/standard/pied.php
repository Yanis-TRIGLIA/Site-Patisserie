<?php
echo '<footer>';
echo '<h2 id="contact">Contactez-nous</h2>';
echo '<form class="contact" method="post" action="">';
echo '<input placeholder="Nom" name="name">';
echo '<input placeholder="E-mail" name="email">';
echo '<textarea placeholder="Votre message ici..." name="message"></textarea>';
echo '<button name="submit" type="submit">Envoyer</button>';
echo '</form>';
echo '<div id="SecondLine"></div>';
echo '<a href="#popup" class="legal_notice">Mentions Légales</a>';
echo '<div id="popup">';
echo  '<div id="popup-content">';
echo    '<div id="popup-header">';
echo      '<a href="#" class="popup-close">&times;</a>';
echo    '</div>';
echo    '<div id="popup-body">';
echo  '<p> Propriété : Le site web est la propriété de IUT Gourmand et est exploité par cette dernière.
<br>
<br>
Contenu : Le contenu de ce site web est protégé par les lois sur les droits d auteur et ne peut être utilisé ou reproduit sans l autorisation écrite de IUT Gourmand.
<br>
<br>
Responsabilité : IUT Gourmand s efforce de maintenir des informations à jour et exactes sur ce site web, mais ne peut être tenu responsable de toute inexactitude .
<br>
<br>
Liens : Ce site web peut contenir des liens vers des sites tiers, qui ne sont pas sous le contrôle de IUT Gourmand. IUT Gourmand n est pas responsable du contenu ou des politiques de ces sites tiers.
<br>
<br>
Données personnelles : IUT Gourmand peut collecter des informations personnelles de ses utilisateurs.
</p>';
echo    '</div>';
echo  '</div>';
echo '</div>';
echo '<div id="copyrightEtIcons">';
echo '<div id="copyright"></div>';
echo '<div id="icons"></div>';
echo '</div>';
echo '</footer>';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $to = "yanis.triglia@etu.univ-amu.fr";
    $subject = "Nouveau message du site web";
    $headers = "From: ".$email;
    mail($to, $subject, $message, $headers);
    echo "Votre message a bien été envoyé.";
}

