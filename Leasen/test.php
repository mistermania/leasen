<?php
require('class/Autoloader.php');
Autoloader::register(0);

$retour =Model::idExiste(2,'Utilisateur');
echo $retour;
 ?>
