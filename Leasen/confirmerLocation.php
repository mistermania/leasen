<?php

session_start();
if (!isset($_SESSION['USER']) || !isset($_SESSION['IDUSER'])) {
    header('Location:index.php');
}

require('class/Autoloader.php');
Autoloader::register();

$newLoc = new Location();
$infosLoc['id_objet'] = filter_input(INPUT_POST, 'id_objet');
$infosLoc['id_utilisateur'] = $_SESSION['IDUSER'];
$infosLoc['date_debut'] = filter_input(INPUT_POST, 'date_debut');
$infosLoc['date_fin'] = filter_input(INPUT_POST, 'date_fin');
echo $res = $newLoc->insert($infosLoc);
header('Location:index.php');