<?php 
 echo '<div class="Navigation_bar">
 <form method="post" action="/home/search" class="Navigation_bar">
 <ul>
 <li class><a class="backgroundimage" href="https://tpphp1.alwaysdata.net/home">_ </a></li>
 <li style="float:middle">
 <input class="Search" type="text" name="query" placeholder="Recherche...">
 </li>
 <li style="float:middle">
 <button class="Searchbutton" type="submit"></button>
 </li>
 <li style="float:right"><a class="login" href="/home/logIn">se connecter</a></li>
 <li style="float:right"><a class="sigin" href="/home/register">s\'enregistrer</a></li>
 </ul>
</form>
</div>

<link rel="stylesheet" href="Css/stylesite.css">
<div class="Title_page_profil">
        <h1 class="Profile"> Profil</h1>
    </div>
    <div class="Profile_card">
        <img class="Profile_picture" src="Banque_dimage/Silvain.png" alt="Photo_profil"/>
        <div class="Login_Displayname">
            <div class="Login">
                <p><strong>Login : </strong></p>
                <p>Silvain</p>
            </div>
            <div class="Display">
                <p><strong>Display Name : </strong></p>
                <p>Sylvanus le Christ-Cosmique</p>
            </div>
        </div>
        <div class="First_Last">
            <div class="First">
                <p><strong>First Seen : </strong></p>
                <p>10 Jan 0002</p>
            </div>
            <div class="Last">
                <p><strong>Last Seen : </strong></p>
                <p>16 Jan 2023</p>
            </div>
        </div>
    </div>   
</body>
';