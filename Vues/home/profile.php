<?php 
 echo '<link rel="stylesheet" href="Css/stylesite.css">
<div class="Title_page_profil">
        <h1 class="Profile"> Profil</h1>
    </div>
    <div class="Profile_card">
        <img class="Profile_picture" src='.$A_vue[2].' alt="Photo_profil"/>
        <div class="Login_Displayname">
            <div class="Login">
                <p><strong>Login : </strong></p>
                <p>'.$A_vue[1].'</p>
            </div>
            <div class="Display">
                <p><strong>Display Name : </strong></p>
                <p>'.$A_vue[0].'</p>
            </div>
        </div>
        <div class="First_Last">
            <div class="First">
                <p><strong>First Seen : </strong></p>
                <p>'.$A_vue[3].'</p>
            </div>
            <div class="Last">
                <p><strong>Last Seen : </strong></p>
                <p>'.$A_vue[4].'</p>
            </div>
        </div>
    </div>   
</body>
';
