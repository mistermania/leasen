<?php
session_start();
require('../class/Autoloader.php');
Autoloader::register(1);
include "../fonctions/fnavbar.php";
navbarcall(1, 4);


$newobjet = new Objet();
$idobjet = filter_input(INPUT_POST, 'id_objet');
$objetModif['nom_objet'] = filter_input(INPUT_POST, 'nom');
$objetModif['description_objet'] = filter_input(INPUT_POST, 'description');
$objetModif['prix'] = filter_input(INPUT_POST, 'prix');
$objetModif['prix_caution'] = filter_input(INPUT_POST, 'prix_caution');
$objetModif['id_utilisateur'] = $_SESSION['IDUSER'];
$modif = $newobjet->update($objetModif, $idobjet);
header('Location:../index.php');