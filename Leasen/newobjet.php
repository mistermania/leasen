<?php
session_start();
if(!isset($_SESSION['USER']) || !isset($_SESSION['IDUSER']))
{
    header('Location:index.php');
}

require('class/Autoloader.php');
Autoloader::register(0);


$newobjet = new Objet();
$objetInfos['nom_objet'] =  filter_input(INPUT_POST, 'nom');
$objetInfos['description_objet']=  filter_input(INPUT_POST, 'description');
$objetInfos['id_type'] = filter_input(INPUT_POST, 'categorie');
$objetInfos['prix']=filter_input(INPUT_POST,'prix');
$objetInfos['prix_caution']=filter_input(INPUT_POST,'prix_caution');
$objetInfos['id_utilisateur']=$_SESSION['IDUSER'] ;
$test= $newobjet->insert($objetInfos);
header('Location:index.php');
