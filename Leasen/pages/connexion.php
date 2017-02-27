<?php
session_start();
include "../fonctions/fnavbar.php";
?>
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
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link href="../css/navbar.css" rel="stylesheet" type="text/css"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="../css/footerb.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
if (isset($_SESSION['USER'])) {
    navbarcall(1, 0);
    echo "Bienvenue " . $_SESSION['USER'];
    echo "<p>Vous êtes déjà connecté. Souhaitez vous vous déconnecter ?</p>";
    echo '<input type="button" value="Deconnexion" onclick="document.location.href=\'../fonctions/deco.php\';">';
    echo '<input type="button" value="Retour" onclick="document.location.href=\'../index.php\';">';
} else {
    navbarcall(0, 0);
    ?>
    <div class="grey lighten-3">
        <div class="row">
            <br/>
            <h3 class=" center-align grey-text text-darken-4">Connexion </h3><br/>
            <p class=" center-align deep-orange-text">Entrez vos informations de login pour vous connecter </p>
            <form method="post" class="col s6 offset-s3" action="signin.php">
                <label for="user_email" class="col s6 offset-s3 green-text text-darken-4">Email: </label>
                <input type="email" class="col s6 offset-s3 white green-text text-darken-4 " name="user_email" required
                       id="user_email"/><br/>
                <label for="pass" class="col s6 offset-s3 green-text text-darken-4">Mot de passe:</label>
                <input type="password" class="col s6 offset-s3 white green-text text-darken-4" name="pass" required
                       id="pass"/><br/>
                <input type="submit" class="deep-orange btn col s6 offset-s3" value="Connexion"/>
            </form>
        </div>
        <br/>
    <?php

include"../fonctions/footer.php";
footer();
?>   
    </div>
    <br/>
    <?php
}

?>
</body>
</html>