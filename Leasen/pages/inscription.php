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
        <link href="../css/piedpage.css" rel="stylesheet" type="text/css"/>
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
        <script src="../js/principale.js" type="text/javascript"></script>

        <?php
        include "../fonctions/footer.php";
        include "../fonctions/fnavbar.php";
        navbarcall(0, 0);
        ?>

        <div class="row">
            <br/>
            <h3 class="center-align grey-text text-darken-4">Inscription</h3>
            <br/>
            <p class="center-align deep-orange-text">Merci de renseigner les différents champs afin de vous inscrire</p>
            <?php
            $resu = filter_input(INPUT_POST, 'resu');
            if (isset($resu)) {
                if ($resu == 1) {
                      echo "<p class=\"center-align deep-orange-text\">nom, prenom ou email absent</p>";
                }
                if ($resu == 2) {
                    echo "<p class=\"center-align deep-orange-text\">numero de téléphone non valide</p>";
                }
              
                if ($resu == 3) {
                    echo "<p class=\"center-align deep-orange-text\">adresse mail invalide</p>";
                }
                if ($resu == 4) {
                    echo "<p class=\"center-align deep-orange-text\">mot de passe trop faible (moins de 8 caractère, pas de chiffre ou/et pas de majuscules</p>";
                }

                if ($resu == 5) {
                    echo "<p class=\"center-align deep-orange-text\">Adresse déjà utilisée</p>";
                }
                if ($resu == 6) {
                    echo "<p class=\"center-align deep-orange-text\">numero de telephone déjà utilisé</p>";
                }
            }
            ?>
            <form method="post" class="col s12 m12 l8 offset-l2" action="./signup.php">
                <label for="nom" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 grey-text text-darken-4 ">Nom :</label>
                <input type="text" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 white grey-text text-darken-4 " name="nom" required id="nom"/>
                <label for="prenom" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 grey-text text-darken-4">Prenom :</label>
                <input type="text" class=" col s10 offset-s1 m6 offset-m3 l8 offset-l2 white grey-text text-darken-4 " name="prenom" required
                       id="prenom"/>
                <label for="pass" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 grey-text text-darken-4">Mot de passe :</label>
                <input type="password" class=" col s10 offset-s1 m6 offset-m3 l8 offset-l2 white grey-text text-darken-4 " name="pass" required
                       id="pass"/>
                <label for="user_email" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 grey-text text-darken-4">Email:</label>
                <input type="email" class=" col s10 offset-s1 m6 offset-m3 l8 offset-l2 white grey-text text-darken-4 " name="user_email"
                       id="user_email">
                <label for="numerotel" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 grey-text text-darken-4">Numero de telephone:</label>
                <input type="tel" class=" col s10 offset-s1 m6 offset-m3 l8 offset-l2 white grey-text text-darken-4" name="numerotel" id="numerotel">
                <label for="telchoix" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 grey-text text-darken-4"> Partager votre numéro
                    ? </label><br/>
                <select name="telchoix" id="telchoix"
                        class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 white grey-text text-darken-4 browser-default">
                    <option value="1" selected>Oui</option>
                    <option value="0">Non</option>
                </select>
                <!--  <label class="col s6 offset-s3 grey-text text-darken-4">Oui
                      <input type="radio" name="telchoix" value="1">
                  </label>
                  <label class="col s6 offset-s3 grey-text text-darken-4">Non
                      <input type="radio" class="floating-btn" name="telchoix" value="0">
                  </label> -->
                <input type="submit" class=" col s6 offset-s3 deep-orange btn" value="M'inscrire"/>

            </form> 
        </div> 

        <br/>
    </body>
</html>