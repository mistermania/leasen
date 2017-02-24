<?php

session_start();
require('../class/Autoloader.php');
Autoloader::register(1);

$idobjet = filter_input(INPUT_POST, 'id_objet');
$newLocation = new Location();

$locationInfos['id_location'] = filter_input(INPUT_POST, 'id_location');
$res = $newLocation->find($locationInfos);

foreach ($res as $k => $v) {
    echo 'id location :'.$v['id_location'].'<br>';
    $locationModif['id_location'] = $v['id_location'];
    
    echo 'date debut'.$v['date_debut'].'<br>';
    $locationModif['date_debut'] = $v['date_debut'];
    
    echo 'date fin'.$v['date_fin'].'<br>';
    $locationModif['date_fin'] = $v['date_fin'];
    
    echo 'statut location'.$v['statut_location'].'<br>';
    $locationModif['statut_location'] = $v['statut_location'];
    
    echo 'date demande'.$v['date_demande'].'<br>';
    $locationModif['date_demande'] = $v['date_demande'];
    
    echo 'id utilisateur'.$v['id_utilisateur'].'<br>';
    $locationModif['id_utilisateur'] = $v['id_utilisateur'];
    
    echo 'id objet'.$v['id_objet'].'<br>';
    $locationModif['id_objet'] = $v['id_objet'];
}


$locationModif['statut_location'] = 2;


echo 'new statut :'.$locationModif['statut_location'];

$modif = $newLocation->update($locationModif, $idobjet);

echo '<br> retour fonction'.$modif;


