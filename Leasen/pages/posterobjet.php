<html>
<head>
    <meta charset="utf-8"/>
    <script type="text/javascript" src="../js/research.js"></script>
    <script type="text/javascript" src="../js/xhr.js"></script>
    <script type="text/javascript" src="../js/posterobjet.js"></script>
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
navbarcall(1, 3);
require('../class/Autoloader.php');
Autoloader::register(1);
$req = 'id_type >0';
$ty = new Type();
$res = $ty->find($req);
?>
<div class="grey lighten-3">
    <div class="row ">
        <div class="row">
            <div>
                <br>
                <h5 class="center-align grey-text text-darken-4">Poster un objet en location</h5>
                <br>
            </div>
        </div>
        <form method="post" class="col s6 offset-s3  " action="../newobjet.php">
            <label for="nom" class="col s6 offset-s3 grey-text text-darken-4">Titre de l'annonce</label><br/>
            <input type="text" id="nom" name="nom" class="col s6 offset-s3 white"
                   placeholder="Ex: Appareil à Raclette"/>
            <label for="categorie" class="col s6 offset-s3 grey-text text-darken-4">Categorie</label>
            <select id="categorie" class="col s6 offset-s3 browser-default white " name="categorie">
                <?php
                foreach ($res as $k => $v) {
                    echo "<option value=\"" . $v["id_type"] . "\">" . $v["description_type"] . "</option>";
                }
                ?>
            </select>
            <label for="description" class="col s6 offset-s3 grey-text text-darken-4">Description du bien</label>
            <textarea name="description" class="col s6 offset-s3 white " id="description"
                      placeholder="Ex: Appareil pour 8 personnes"></textarea>
            <input type="button" class="col s6 offset-s3 deep-orange btn" value="Ajouter un prix"
                   onclick="afficher_cacher('id_div_prix'); ">
            <div id="id_div_prix" style="display:none">
                <label for="prix" class="col s6 offset-s3 grey-text text-darken-4">Prix de la location à la
                    journée </label>
                <input type="number" class="col s6 offset-s3 white" id="prix" name="prix" min="0" value="0"/>
            </div>
            <input type="button" class="col s6 offset-s3 deep-orange btn" value="Ajouter une caution"
                   onclick="afficher_cacher('id_div_caution');">
            <div id="id_div_caution" style="display:none">
                <label for="prix_caution" class="col s6 offset-s3 grey-text text-darken-4">Montant de la caution</label>
                <input type="number" class="col s6 offset-s3 white" id="prix_caution" name="prix_caution" min="0"
                       value="0"/>
            </div>
            <input type="submit" class=" col s6 offset-s3 deep-orange btn" value="Poster">
        </form>
        <br>
    </div>
    <footer class="page-footer cyan darken-1">
        <div class="footer-copyright">
            <div class="container">
                © 2017 LEASEN Tous droits réservés.
            </div>
        </div>
    </footer>
</div>
</body>
</html>