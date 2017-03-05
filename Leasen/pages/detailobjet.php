<?php
session_start();
if (!isset($_SESSION['USER']) || !isset($_SESSION['IDUSER'])) {
    header('Location:../index.php');
}
?>
    <html>
<head>
    <meta charset="utf-8"/>
    
    <script type="text/javascript" src="../js/xhr.js"></script>
    <script type="text/javascript" src="../js/calendrier.js"></script>
    <link href="../css/piedpage.css" rel="stylesheet" type="text/css"/>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <!-- <link href="css/navbar.css" rel="stylesheet" type="text/css"/> -->
    <link href="../css/paccueil.css" rel="stylesheet" type="text/css"/>
    <!--Let browser know website is optimized for mobile-->
    <!--css pour le calendrier-->
    <link href="../css/calendar.css" type="text/css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="../css/detailobj.css" rel="stylesheet" type="text/css"/>
</head>
<body onload="calendrier(-1,-1)">
    <!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
    <script src="../js/principale.js" type="text/javascript"></script>

<?php
require('../class/Autoloader.php');
Autoloader::register(1);

include "../fonctions/fnavbar.php";
navbarcall(1, 2);
$newobjet = new Objet();
$objetInfos['id_objet'] = filter_input(INPUT_POST, 'id_objet');
$swap = filter_input(INPUT_POST, 'swap');
//echo 'id objet: '.$s.'</br>';
$res = $newobjet->find($objetInfos);

?>

    <br/><br/>
    <div class="container white ">
       
        <?php
        foreach ($res as $k => $v) { 
            echo ' <h4 class="titre">' . $v["nom_objet"] . "</h4>";
            echo '  <p class="description"> Description : ' . $v["description_objet"] . "<br/>";
            echo "Caution : " . $v["prix_caution"] . "<br/>";
            echo "Prix : " . $v["prix"] . "</p>";
           
            if ($v["url_photo"] != NULL) {
                echo '<img src =../' . $v["url_photo"] . ' class="imgobjet">';
            }
        }
        $infosLoc['id_objet'] = $objetInfos['id_objet'];
        $infosLoc['id_utilisateur'] = $_SESSION['IDUSER'];
        $infosLoc['date_debut'] = filter_input(INPUT_POST, 'date');
        $duree = filter_input(INPUT_POST, 'duree');
        if (empty($infosLoc['date_debut']) OR empty($duree)) {
            ?>
            <form method="post" class="col s12 " action="../fonctions/confirmerLocation.php">
                <br/><br/>
                <div id="hide" style="display:none">
                    <label for="id_objet"></label>
                    <input type="number" id="id_objet" name="id_objet"
                           value="<?php echo $infosLoc["id_objet"]; ?>"/>
                </div>
                <label for="date_debut" class="col s12 grey-text text-darken-4"> Date du début
                    de la location</label>
                <input type="date" id="date_debut"
                       class="col s6 offset-s3 white grey-text text-darken-4" name="date_debut"
                       placeholder="Date: Année-Mois-Jour"/>
                <label for="duree" class="col s6 offset-s3 grey-text text-darken-4"> Durée de la
                    location </label>
                <input type="number" class="col s6 offset-s3 white grey-text text-darken-4" id="duree"
                       name="duree" min="0" placeholder="Durée de la location"/>
                <input type="submit" class="deep-orange btn co  l s6 offset-s3"
                       value="Envoyer demande de location">
            </form>
            <?php
        } else if (!empty($infosLoc['date_debut']) AND !empty($duree)) {
            ?>
            <form method="post" action="../fonctions/confirmerLocation.php">
                <div id="hide" style="display:none">
                    <label for="id_objet"></label>
                    <input type="number" id="id_objet" name="id_objet"
                           value="<?php echo $infosLoc["id_objet"]; ?>"/>
                    <label for="duree"></label>
                    <input type="number" id="duree" name="duree" value="<?php echo $duree; ?>"/>
                    <label for="date_debut"></label>
                    <input type="date" id="date_debut" name="date_debut"
                           value="<?php echo $infosLoc['date_debut']; ?>"/>
                </div>
                <input type="submit" class="deep-orange btn co  l s6 offset-s3" value="Envoyer demande de location">
            </form>
            <?php
        }
        $recherche = new recherche_question();
        $infoQuestion['id_objet'] = $infosLoc['id_objet'];
        $res = $recherche->effectueRecherche($infoQuestion);
        ?>
        <ul class="collection">
            <?php
            foreach ($res as $k => $v) {
                echo "<li class=\"collection-item avatar\">
            <span class=\"title\">" . $v["nom"] . " " . $v["prenom"] . "</span>
<p>" . $v["contenu_question"] . "</p></li>";
            }
            ?>
            <form method="post" class="col s6 offset-s3" action="../fonctions/posterQuestion.php">
                <label for="question"></label>
                <textarea class="col s6 offset-s3 white green-text text-darken-4" id="question"
                          name="question"> </textarea>
                <div id="hide" style="display:none">
                    <label for="id_objet"></label>
                    <input type="number" id="id_objet" name="id_objet"
                           value="<?php echo $infosLoc["id_objet"]; ?>"/>
                </div>
                <input type="submit" value="Poster votre question" class="deep-orange btn col s6 offset-s3">
            </form>

    </div>
    <div id="calendar" class="white">
        <br/><br/><br/>
    </div>
    

<?php
include "../fonctions/footer.php";
?>
</body>
<?php
?>