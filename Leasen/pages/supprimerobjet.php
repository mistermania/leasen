<?php

session_start();
require('../class/Autoloader.php');
Autoloader::register(1);



$newobjet = new Objet();
$idobjet = filter_input(INPUT_POST, 'id_objet');
$objetModif['o_est_affiche'] = false;
$modif= $newobjet->update($objetModif,$idobjet);
header('Location:pages/moncompte.php');
?>

