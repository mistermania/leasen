<?php
//
session_start();
if (!isset($_SESSION['USER']) || !isset($_SESSION['IDUSER'])) {
    header('Location:../index.php');
}
?>
<html>
<head>
    <meta charset="utf-8"/>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="../css/footerb.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<?php
include "../fonctions/fnavbar.php";
navbarcall(1, 5);
require('../class/Autoloader.php');
Autoloader::register(1);
$infoUser['id_utilisateur'] = $_SESSION['IDUSER'];
$annonce = new Objet();
$infoUser['o_est_affiche'] = true;
$res = $annonce->find($infoUser);
?>

<div class="grey lighten-3">
<div class="grey lighten-3">
    <div class="row ">
        <br/><h5 class="center-align"> Mes annonces </h5> <br>
        <table class="centered bordered responsive-table white grey-text text-darken-4">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Caution</th>
                <th>Prix</th>
                <th> Modifier l'annonce</th>
                <th> Supprimer</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($res as $k => $v) {
                if ($v['o_est_affiche'] == true) {
                    ?>
                    <tr>
                        <td> <?php echo $v["nom_objet"]; ?> </td>
                        <td> <?php echo $v["description_objet"]; ?> </td>
                        <td> <?php echo $v["prix_caution"]; ?> </td>
                        <td> <?php echo $v["prix"]; ?> </td>
                        <td>
                            <form method="post" action="editerobjet.php">
                                <input type="hidden" id="id_objet" name="id_objet"
                                       value="<?php echo $v["id_objet"]; ?>"/>
                                <input type="submit" value="Modifier" class="btn deep-orange darken-1 white-text">
                            </form>
                        </td>
                        <td>
                            <form method="post" action="supprimerobjet.php">
                                <input type="hidden" id="id_objet" name="id_objet"
                                       value="<?php echo $v["id_objet"]; ?>"/>
                                <input type="submit" value="Supprimer" class="btn deep-orange darken-1 white-text">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <br/>
        <?php
        $newuser = new Utilisateur();
        $tel = filter_input(INPUT_POST, 'numerotel');
        $mot_de_passe = filter_input(INPUT_POST, 'pass');
        $newpass = filter_input(INPUT_POST, 'passmodif');
        $varset = filter_input(INPUT_POST, 'varset');

        $test = $newuser->find(array('id_utilisateur' => $_SESSION['IDUSER']));
        if (!empty($test)) {
            $hash = $test[0]['hash_mot_de_passe'];
            if (!empty($test) and $varset==2) {
                if (!password_verify($mot_de_passe, $hash) or (empty($mot_de_passe))) {
                    $varset = filter_input(INPUT_POST, 'varset');
                        ?>
                        <p class=" center-align deep-orange-text">Mot de passe actuel incorrect </p>
                        <?php

                }
                else {
                    if (!empty($newpass)) {
                        $usermodif['mot_de_passe'] = $newpass ;
                        $modif = $newuser->update($usermodif, $_SESSION['IDUSER']);
                        $usermodif['mot_de_passe'] = $newpass;
                        if ($modif == 0){
                            ?>
                            <p class=" center-align deep-orange-text">Mot de passe modifié avec succès. </p>
                            <?php
                        }


                        if ($modif==4){
                            ?>
                            <p class=" center-align deep-orange-text"> Le mot de passe doit au moins contenir une majuscule, un chiffre et faire 8 caractères  </p>
                            <?php
                        }
                    }



                }
            }
            if(!empty($tel) and $varset == 1){
                $usermodif['telephone'] = $tel ;
                $modif = $newuser->update($usermodif, $_SESSION['IDUSER']);
                ?>
                <p class=" center-align deep-orange-text"> Numero modifié  </p>
                <?php
            }
        }

        ?>

        <p class=" center-align deep-orange-text">Modifiez vos informations </p>
        <form method="post" class="col s6 offset-s3" action="moncompte.php">
            <label for="numerotel" class="col s6 offset-s3 green-text text-darken-4">Telephone: </label>
            <input type="tel" class="col s6 offset-s3 white green-text text-darken-4 " name="numerotel" id="numerotel"/><br/>
            <input type="hidden" id="varset" class="col s6 offset-s3 white grey-text text-darken-4"
                   name="varset" value="1"/>
            <input type="submit" class="deep-orange btn col s6 offset-s3" value="Modifier"/>
        </form>

        <form method="post" class="col s6 offset-s3" action="moncompte.php">

            <label for="pass" class="col s6 offset-s3 green-text text-darken-4">Mot de passe actuel:</label>
            <input type="password" class="col s6 offset-s3 white green-text text-darken-4" name="pass" required
                   id="pass"/><br/>
            <label for="passmodif" class="col s6 offset-s3 green-text text-darken-4">Nouveau mot de passe:</label>
            <input type="password" class="col s6 offset-s3 white green-text text-darken-4" name="passmodif" required
                   id="passmodif"/><br/>
            <input type="hidden" id="varset" class="col s6 offset-s3 white grey-text text-darken-4"
                   name="varset" value="2"/>
            <input type="submit" class="deep-orange btn col s6 offset-s3" value="Modifier"/>

        </form>

    </div>
</div>
<?php
include "../fonctions/footer.php";
?>
</body>
</html>