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
        <?php
        session_start(); 
        ?>
         <?php if(isset($_SESSION['USER'])) {echo "Bienvenue ".$_SESSION['USER'];}
         else {echo "Connectez vous";} ?>
        <?php
                if(isset($_SESSION['USER']))
                {
                    echo "<p>Vous êtes déjà connecté. Souhaitez vous vous déconnecter ?</p>";
                    echo '<input type="button" value="Deconnexion" onclick="document.location.href=\'deco.php\';">';
                    echo '<input type="button" value="Retour" onclick="document.location.href=\'index.php\';">' ;
                }
                else {
                    echo"<p>Entrez vos informations de login pour vous connecter : </p>
                        <form method=\"post\" action=\"signin.php\">
                            <label>Email: </label><input type=\"email\" name=\"user_email\" required/><br/>
                            <label>Mot de passe:</label><input type=\"password\" name=\"pass\" required/><br/>
                            <input type=\"submit\" value=\"Connexion\"/>
                        </form>";
                }
                ?>
    </body>
</html>
