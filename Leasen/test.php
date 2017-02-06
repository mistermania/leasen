<?php
require('class/Autoloader.php');
Autoloader::register(0);
$retour = Model::idAbsent(2, 'Utilisateur');
echo $retour;