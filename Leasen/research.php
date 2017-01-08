<?php
require('class/Autoloader.php');
Autoloader::register();
$info=array();
$info['chaine'] = 'clette';
$info['id_type'] = 2;
$info['date_debut'] = '2017-12-15 23:54:36';
$info['duree']=1;
$test= new Recherche();
$res=$test->effectueRecherche($info);
print_r($res);
?>







