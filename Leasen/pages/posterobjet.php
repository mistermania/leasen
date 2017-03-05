<html>
<head>
    <meta charset="utf-8"/>
    <script type="text/javascript" src="../js/research.js"></script>
    <script type="text/javascript" src="../js/xhr.js"></script>
    <script type="text/javascript" src="../js/posterobjet.js"></script>
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
include "../fonctions/fnavbar.php";
navbarcall(1, 3);
include "../fonctions/footer.php";
require('../class/Autoloader.php');
Autoloader::register(1);
$req = 'id_type >0';
$ty = new Type();
$res = $ty->find($req);
?>


    <div class="row ">
        <div class="row">
            <div>
                <br>
                <h5 class="center-align grey-text text-darken-4">Poster un objet en location</h5>
                <br>
            </div>
        </div>
        <form method="post" class="col s12 m12 l8 offset-l2" action="../fonctions/newobjet.php" enctype="multipart/form-data">
            <label for="nom" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 grey-text text-darken-4">Titre de l'annonce</label><br/>
            <input type="text" id="nom" name="nom" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 white"
                   placeholder="Ex: Appareil à Raclette"/>
            <label for="categorie" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 grey-text text-darken-4">Categorie</label>
            <select id="categorie" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 browser-default white " name="categorie">
                <?php
                foreach ($res as $k => $v) {
                    echo "<option value=\"" . $v["id_type"] . "\">" . $v["description_type"] . "</option>";
                }
                ?>
            </select>
            <label for="description" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 grey-text text-darken-4">Description du bien</label>
            <textarea name="description" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 white " id="description"
                      placeholder="Ex: Appareil pour 8 personnes"></textarea>
            <div class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 file-field input-field">
                <div class="deep-orange btn">
                    <span> Ajouter une image</span>
                    <input id="image1"  name="image" type="file"  />
                </div>
                <div class="file-path-wrapper">
                    <label for="image"></label>
                    <input class="file-path validate" type="text" name="image" id="image">
                </div>
            </div>
            
            <input type="button" class="col s6 offset-s3 m4 offset-m4 l4 offset-l4 deep-orange btn" value="Ajouter un prix"
                   onclick="afficher_cacher('id_div_prix');" style="margin-top: 20px"> 
            <div id="id_div_prix" style="display:none">
                <label for="prix" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 grey-text text-darken-4">Prix de la location à la
                    journée </label>
                <input type="number" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 white" id="prix" name="prix" min="0" value="0"/>
            </div>
            <br/><br/><br/>
            
            <input type="button" class="col s6 offset-s3 m4 offset-m4 l4 offset-l4 deep-orange btn" value="Ajouter une caution"
                   onclick="afficher_cacher('id_div_caution');" style="margin-top: 20px">
            <div id="id_div_caution" style="display:none">
                <label for="prix_caution" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 grey-text text-darken-4">Montant de la caution</label>
                <input type="number" class="col s10 offset-s1 m6 offset-m3 l8 offset-l2 white" id="prix_caution" name="prix_caution" min="0"
                       value="0"/>
            </div>
            <input type="submit" class=" col s6 offset-s3 m4 offset-m4 l4 offset-l4 deep-orange btn" style="margin-top: 20px" value="Poster">
        </form>
        
    </div>
   

</body>
</html>