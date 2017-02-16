<?php
session_start();
if (!isset($_SESSION['USER']) || !isset($_SESSION['IDUSER'])) {
    header('Location:../index.php');
}
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

<?php
include "../fonctions/fnavbar.php";
navbarcall(1, 0);
$newobjet = new Objet();
$objetInfos['id_objet'] = filter_input(INPUT_POST, 'id_objet');
//echo $objetInfos['id_objet'];
$res = $newobjet->find($objetInfos);
foreach ($res as $k => $v) {
    echo "<h1>" . $v["nom_objet"] . "</h1><br/>";
    echo "Description:<br/>" . $v["description_objet"] . "<br/>";
    echo "Caution:" . $v["prix_caution"] . "<br/>";
    echo "Prix:" . $v["prix"] . "<br/>";
}
$infosLoc['id_objet'] = filter_input(INPUT_POST, 'id_objet');
$infosLoc['id_utilisateur'] = $_SESSION['IDUSER'];
$infosLoc['date_debut'] = filter_input(INPUT_POST, 'date');
$duree = filter_input(INPUT_POST, 'duree');

if (empty($infosLoc['date_debut']) OR empty($duree)) {
    ?>
    <form method="post" action="../fonctions/confirmerLocation.php">
        <div id="hide" style="display:none">
        <label for="id_objet"></label>
        <input type="number" id="id_objet" name="id_objet" value="<?php echo $infosLoc["id_objet"]; ?>"/>
        </div>
        <label for="date_debut"></label>
        <input type="date" id="date_debut" name="date_debut" placeholder="Date: Année-Mois-Jour"/>
        <label for="duree"></label>
        <input type="number" id="duree" name="duree" min="0" placeholder="Durée de la location"/>
        <input type="submit" value="Envoyer demmande de location">
    </form>
    <?php
}else if (!empty($infosLoc['date_debut']) AND !empty($duree)) {
    ?>
    <form method="post" action="../fonctions/confirmerLocation.php">
        <div id="hide" style="display:none">
            <label for="id_objet"></label>
            <input type="number" id="id_objet" name="id_objet" value="<?php echo $infosLoc["id_objet"]; ?>"/>
            <label for="duree"></label>
            <input type="number" id="duree" name="duree" value="<?php echo $duree; ?>"/>
            <label for="date_debut"></label>
            <input type="date" id="date_debut" name="date_debut" value="<?php echo $infosLoc['date_debut']; ?>"/>
        </div>
        <input type="submit" value="Envoyer demmande de location">
    </form>
<?php
}
$test = new Question();
$infoQuestion['id_objet'] = $infosLoc['id_objet'];
$res = $test->find($infoQuestion);
foreach ($res as $k => $v) {
    echo "<div>" . $v["contenu_question"] . "</div>";
}
?>
<form method="post" action="../fonctions/posteQuestion">
    <textarea id="question" name="question"> </textarea>
    <input type="submit" value="Poster votre question">
</form>
</body>
<?php
?>
