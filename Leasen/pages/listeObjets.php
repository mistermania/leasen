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
<body onload="request();">

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script src="../js/principale.js" type="text/javascript"></script>

<?php
include "../fonctions/footer.php";
include "../fonctions/fnavbar.php";
navbarcall(1, 2);
$req = 'id_type > 0';
$ty = new Type();
$res = $ty->find($req);
?>


    <div class="row ">
        <div>
            <br>
            <h5 class="center-align grey-text text-darken-4">Que cherchez-vous ?</h5>
            <br>
            <br>
        </div>
        <form class="col s12 m12 l12">
            <div class="col s12 m4 l3">
                <label for="categorie"></label>
                <select id="categorie" class="browser-default center-align white" name="categorie" oninput="request();">
                    <option value="0">Toutes les categories</option>
                    <?php
                    foreach ($res as $k => $v) {
                        echo "<option value=\"" . $v["id_type"] . "\">" . $v["description_type"] . "</option>";
                    }
                    ?>
                </select> <br/>
            </div>
            <div class="col s12 m4 l3">
                <input class="white validate datepicker" type="date" id="date" name="date" placeholder="Date:
			 Année-Mois-Jour" oninput="request();" min="<?php echo date('Y-m-d'); ?>" max="2050-01-01"/>
            </div>
            <div class="col s12 m4 l3">
                <input class="white" type="number" id="duree" min="0" placeholder="Durée de la location"
                       oninput="request();"/>
            </div>
            <div class="col s12 m6 offset-m3 l3">
                <input class="white" type="text" id="recherche" placeholder="Taper votre recherche"
                       onkeyup="request();"/>
            </div>
        </form>
    </div>
    <p id="result"></p>


</body>
</html>