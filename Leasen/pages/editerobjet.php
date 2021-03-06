<?php
session_start();
require('../class/Autoloader.php');
Autoloader::register(1);
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8"/>
    <link href="../css/piedpage.css" rel="stylesheet" type="text/css"/>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
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
navbarcall(1, 2);
$objetInfos['id_objet'] = filter_input(INPUT_POST, 'id_objet');
$newobjet = new Objet();
$res = $newobjet->find($objetInfos);
?>
<html>

    <br/>
    <h3 class="center-align grey-text text-darken-4">Modifier une annonce </h3><br/>
    <div class="row ">
        <form method="post" class="col s6 offset-s3" action="./updateobjet.php">
            <?php
            foreach ($res as $k => $v) {
                ?>
                <label for="nom" class="col s6 offset-s3 grey-text text-darken-4">Nom du bien</label><br/>
                <input type="text" id="nom" class="col s6 offset-s3 white grey-text text-darken-4" name="nom"
                       value="<?php echo $v["nom_objet"]; ?>"/>
                <label for="description" class="col s6 offset-s3 grey-text text-darken-4">Description du bien</label>
                <br/>
                <input type='text' id="description" class="col s6 offset-s3 white grey-text text-darken-4"
                       name="description" value="<?php echo $v["description_objet"]; ?>"/>
                <label for="prix" class="col s6 offset-s3 grey-text text-darken-4">Prix de la location à la
                    journée </label><br/>
                <input type="number" id="prix" class="col s6 offset-s3 grey-text white text-darken-4" name="prix"
                       min="0" value="<?php echo $v["prix"]; ?>"/>
                <label for="prix_caution" class="col s6 offset-s3 grey-text text-darken-4">Prix de la caution </label>
                <br/>
                <input type="number" id="prix_caution" class="col s6 offset-s3 white grey-text text-darken-4"
                       name="prix_caution" min="0" value="<?php echo $v["prix_caution"]; ?>"/>
                <input type="hidden" id="id_objet" class="col s6 offset-s3 white grey-text text-darken-4"
                       name="id_objet" value="<?php echo $v["id_objet"]; ?>"/>
                <input type="submit" class=" col s6 offset-s3 deep-orange btn" value="Mettre à jour">
                <?php
            }
            ?>
        </form>
    </div>
    
