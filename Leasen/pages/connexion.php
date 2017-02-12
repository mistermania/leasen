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
</head>
<body>
<?php
session_start();
include "../fonctions/fnavbar.php";
?>
<?php
if (isset($_SESSION['USER'])) {
    navbarcall(1, -1);
    echo "Bienvenue " . $_SESSION['USER'];
    echo "<p>Vous êtes déjà connecté. Souhaitez vous vous déconnecter ?</p>";
    echo '<input type="button" value="Deconnexion" onclick="document.location.href=\'../fonctions/deco.php\';">';
    echo '<input type="button" value="Retour" onclick="document.location.href=\'../index.php\';">';
} else {
    navbarcall(0, -1);
    ?>
    Connectez vous
    <p>Entrez vos informations de login pour vous connecter : </p>
    <form method="post" action="signin.php">
        <label for="user_email">Email: </label><input type="email" name="user_email" required id="user_email"/><br/>
        <label for="pass">Mot de passe:</label><input type="password" name="pass" required id="pass"/><br/>
        <input type="submit" value="Connexion"/>
    </form>
    <?php
}
?>
</body>
</html>