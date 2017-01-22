<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div id="content">
                <h1>Inscription</h1>
                <p>Merci de renseigner les différents champs afin de vous inscrire</p>
                <form method="post" action="./signup.php">
                    <label for="nom">nom :</label><input type="text" name="nom" required id="nom"/>
                    <label for="prenom">prenom :</label><input type="text" name="prenom" required id="prenom"/>
                    <label for="pass">Mot de passe :</label><input type="password" name="pass" required id="pass"/>
                    <label for="user_email">Email:</label><input type="email" name="user_email" id="user_email">
                    <label for="numerotel">Numero de telephone:</label><input type="tel" name="numerotel" id="numerotel">
                    <label>partager telephone:</label>
                    <label>Oui
                    <input type="radio" name="telchoix" value="1">
                    </label>
                    <label>Non
                    <input type="radio" name="telchoix" value="0">
                    </label>
                    
                    <input type="submit" value="M'inscrire"/>
                </form>
        </div>
        
    </body>
</html>
