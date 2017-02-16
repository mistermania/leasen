<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html> 
 
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <!-- <link href="css/navbar.css" rel="stylesheet" type="text/css"/> -->
    <link href="../css/paccueil.css" rel="stylesheet" type="text/css"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
<?php
    include "../fonctions/fnavbar.php";
    navbarcall(0, 0);
?>
<div class="grey lighten-3">
<div class="row"> 
    <br/>
    <h3 class="center-align grey-text text-darken-4">Inscription</h3>
    
    
    <br/>
    <p class="center-align deep-orange-text">Merci de renseigner les différents champs afin de vous inscrire</p>
    <form method="post" class="col s6 offset-s3" action="./signup.php">
        <label for="nom" class="col s6 offset-s3 grey-text text-darken-4 ">Nom :</label>
        <input type="text" class=" col s6 offset-s3 white grey-text text-darken-4 " name="nom" required id="nom"/>
        <label for="prenom" class="col s6 offset-s3 grey-text text-darken-4">Prenom :</label>
        <input type="text" class=" col s6 offset-s3 white grey-text text-darken-4 "name="prenom" required id="prenom"/>
        <label for="pass" class="col s6 offset-s3 grey-text text-darken-4">Mot de passe :</label>
        <input type="password" class=" col s6 offset-s3 white grey-text text-darken-4 " name="pass" required id="pass"/>
        <label for="user_email" class="col s6 offset-s3 grey-text text-darken-4">Email:</label>
        <input type="email" class=" col s6 offset-s3 white grey-text text-darken-4 " name="user_email" id="user_email">
        <label for="numerotel" class="col s6 offset-s3 grey-text text-darken-4">Numero de telephone:</label>
        <input type="tel" class=" col s6 offset-s3 white grey-text text-darken-4 " name="numerotel" id="numerotel">
        
        <label class="col s6 offset-s3 grey-text text-darken-4"> Partager votre numéro ? </label><br/>
        <select name="telchoix" class="col s6 offset-s3 white grey-text text-darken-4 browser-default">
            <option value="1" selected>Oui</option>
            <option value="0">Non </option>
        </select>
        
      <!--  <label class="col s6 offset-s3 grey-text text-darken-4">Oui
            <input type="radio" name="telchoix" value="1">
        </label>
        <label class="col s6 offset-s3 grey-text text-darken-4">Non
            <input type="radio" class="floating-btn" name="telchoix" value="0">
        </label> -->
        <br/>
        <input type="submit" class=" col s6 offset-s3 deep-orange btn" value="M'inscrire"/>
    </form>
    </div>
    <br/>
     <!--//footer-->
<footer class="page-footer cyan darken-1">
    <div class="container cyan darken-1">
    <div class="row">
    <div class="col l6 s12">
      <p class="grey-text text-lighten-4">You can use rows and columns here to organize your
                                footer content.</p>
    </div>
    </div>
    </div>
    <div class="footer-copyright">
    <div class="container">
        © 2017 LEASEN Tous droits réservés.
                        
    </div>
    </div>
</footer>
</div>

</body>


</html>
