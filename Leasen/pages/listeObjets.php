<?php
session_start();
require('../class/Autoloader.php');
Autoloader::register(1);
?>
<html>
<head>
    <meta charset="utf-8"/>
    <script type="text/javascript" src="../js/research.js"></script>
    <script type="text/javascript" src="../js/xhr.js"></script>
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
navbarcall(1, 2);
$req = 'id_type > 0';
$ty = new Type();
$res = $ty->find($req);
?>
 <div class="grey lighten-3">
<div class="row "> 
    <div>
        
        </br><span class="grey-text text-darken-4 "><h5 class="center-align">Que cherchez-vous ?</h5> </span></br></br>
    </div>

    <form class="col s12">
        <div class="col s3">
            <label for="categorie"></label>
            <select id="categorie" class="browser-default center-align white" name="categorie" oninput="request();">
                <option value="0">Toutes les categories</option>
                <?php
                foreach ($res as $k => $v) {
                    echo "<option value=\"" . $v["id_type"] . "\">" . $v["description_type"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col s3">
            <input class="white" type="date" id="date" name="date" placeholder="Date:
			 Année-Mois-Jour" oninput="request();"/>
        </div>
        <div class="col s3">
            <input class="white" type="number" id="duree" min="0" placeholder="Durée de la location" oninput="request();"/>
        </div>
        <div class="col s3">
            <input class="white" type="text" id="recherche" placeholder="Taper votre recherche" onkeyup="request();"/>
        </div>
    </form>
</div>
 
<p id="result"></p>

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