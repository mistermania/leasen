<?php

session_start();
require('../class/Autoloader.php');
Autoloader::register(1);

$idobjet = filter_input(INPUT_POST, 'id_objet');
$newLocation = new Location();

$locationInfos['id_objet'] = filter_input(INPUT_POST, 'id_objet');
$res = $newLocation->find($locationInfos);

foreach ($res as $k => $v) {
    echo $v['id_location'];
    echo $v['date_debut'];
    echo $v['date_fin'];
    echo $v['statut_location'];
    echo $v['date_demande'];
    echo $v['id_utilisateur'];
    echo $v['id_objet'];
}


$locationModif['statut_location'] = '2';

$modif = $newLocation->update($locationModif, $idobjet);


