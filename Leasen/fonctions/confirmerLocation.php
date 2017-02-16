<?php

session_start();
if (!isset($_SESSION['USER']) || !isset($_SESSION['IDUSER'])) {
    header('Location:../index.php');
}
require('../class/Autoloader.php');

$infosLoc['id_objet'] = filter_input(INPUT_POST, 'id_objet');
$infosLoc['id_utilisateur'] = $_SESSION['IDUSER'];
$infosLoc['date_debut'] = filter_input(INPUT_POST, 'date_debut');
$duree = filter_input(INPUT_POST, 'duree');
if(isset($infosLoc['date_debut'])){
    //echo "date debut : ",$infosLoc['date_debut'],"<br> duree : ", $duree;
}else{
    echo "date debut non defini <br>";
}
//creation d'un ojet datetime pour permettre l'ajout de la duree
$date_debut = new DateTime($infosLoc['date_debut']);
// durée transformée en un objet date interval (durée en jour)
$date_duree = new DateInterval('P' . $duree . 'D');
$infosLoc['date_fin'] = $date_debut->add($date_duree)->format('Y-m-d');
echo "id objet : ",$infosLoc['id_objet'], "<br>" ;
echo "id utilisateur : ",$infosLoc['id_utilisateur'], "<br>" ;
echo "date debut : ", $infosLoc['date_debut'], "<br>" ;
echo "date fin : ",$infosLoc['date_fin'],"<br>" ;
Autoloader::register(1);
$newLoc = new Location();
$res = $newLoc->insert($infosLoc);
echo "resultat de la requete :",$res,"<br>";
if( $res == 0) {
    echo "Demmande de location envoyé <br>";
}else{
    echo "Une erreur est survenu lors de votre requete <br>";
}
echo"Vous allez être redirigez dans 5 secondes";
header('Refresh:5; URL=../index.php');

