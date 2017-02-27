<?php

session_start();
require('../class/Autoloader.php');
Autoloader::register(1);

$idLoc = filter_input(INPUT_POST, 'id_loc');
$newLocation = new Location();
$locationModif['statut_location'] = '2';
$modif = $newLocation->update($locationModif, $idLoc);
echo $modif;


echo '<br> retour fonction'.$modif;
