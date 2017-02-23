<?php
require('class/Autoloader.php');
Autoloader::register(0);
$retour = Model::idAbsent(2, 'Utilisateur');
$lunette = new Objet();
$lunette->delete(18);
echo "<pre>";
print_r($lunette->find("id_objet>1","",5));
echo "</pre>";
echo $retour;