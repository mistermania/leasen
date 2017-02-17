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
$infosQuestion['contenue_question'] = filter_input(INPUT_POST, 'question');
$infosQuestion['id_utilisateur'] = $_SESSION['IDUSER'];
$infosQuestion['id_objet'] = filter_input(INPUT_POST, 'id_objet');
$newQuestion = new Question();
$res = $newQuestion->insert($infosQuestion);

echo "id objet :  " . $infosQuestion['id_objet']."<br>";
echo "question :  " . $infosQuestion['contenue_question']."<br>";
echo "id utilisateur :  " . $infosQuestion['id_utilisateur']."<br>";
echo "Resultat de la requete: " . $res;