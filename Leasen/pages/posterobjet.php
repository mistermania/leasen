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
navbarcall(1, 4);
require('../class/Autoloader.php');
Autoloader::register(1);
$req = 'id_type >0';
$ty = new Type();
$res = $ty->find($req);
?>
<div class="row ">
    <form method="post" class="col s12" action="../newobjet.php">
        <label for="nom">Titre de l'annonce</label><br/>
        <input type="text" id="nom" name="nom" class="col s12" placeholder="Ex: Appareil à Raclette"/>
        <label for="categorie">Categorie</label>
        <select id="categorie" class="col s12 browser-default " name="categorie">
            <?php
            foreach ($res as $k => $v) {
                echo "<option value=\"" . $v["id_type"] . "\">" . $v["description_type"] . "</option>";
            }
            ?>
        </select>
        <br>
        <label for="description">Description du bien</label>
        <textarea name="description" class="col s12 " id="description"
                  placeholder="Ex: Appareil pour 8 personnes"></textarea>
        <input type="button" class="col s12" value="Ajouter un prix" onclick="afficher_cacher('id_div_prix'); ">
        <div id="id_div_prix" style="display:none">
            <label for="prix">Prix de la location à la journée </label>
            <input type="number" class="col s12" id="prix" name="prix" min="0" value="0"/>
        </div>
        <input type="button" class=" col s12" value="Ajouter une caution"
               onclick="afficher_cacher('id_div_caution');">
        <div id="id_div_caution" style="display:none">
            <label for="prix_caution">prix Cautions</label>
            <input type="number" class="col s12" id="prix_caution" name="prix_caution" min="0" value="0"/>
        </div>
        <input type="submit" class=" col s12" value="Poster">
    </form>
</div>
</body>
</html>
