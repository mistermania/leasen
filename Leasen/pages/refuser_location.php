<?php

session_start();
require('../class/Autoloader.php');
Autoloader::register(1);

$newLocation = new Location();
$idobjet = filter_input(INPUT_POST, 'id_objet');

$locationModif['statut_location']=5;

$modif = $newLocation->update($locationModif,$idobjet);
