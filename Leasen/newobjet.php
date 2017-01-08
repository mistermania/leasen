<?php

require('class/Autoloader.php');
Autoloader::register();

print_r($_POST);
echo '<br>';
$newobjet = new Objet();

$objetInfos['nom_objet'] =  filter_input(INPUT_POST, 'nom');
$objetInfos['description_objet']=  filter_input(INPUT_POST, 'description');
$objetInfos['id_type'] = filter_input(INPUT_POST, 'categorie');

if(isset($_POST['prix'])){
    echo 'bob';
    $objetInfos['prix']=$_POST['prix'];
    $objetInfos['est_payant'] = true;
}
if(isset($_POST['prix_caution'])){
    $objetInfos['prix_caution'] =$_POST['prix_caution'];
    $objetInfos['a_une_caution'] = true;
}

$objetInfos['id_utilisateur']=2 ;
print_r($objetInfos);
echo $test= $newobjet->insert($objetInfos);
/**
 *
*
*if($test == 1) {
*echo "";
*/