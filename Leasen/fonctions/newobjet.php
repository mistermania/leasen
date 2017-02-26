<?php
session_start();
if (!isset($_SESSION['USER']) || !isset($_SESSION['IDUSER'])) {
    header('Location:index.php');
}
require('../class/Autoloader.php');
Autoloader::register(0);
$maxsize = 1000;
$erreur = 0 ;
$extensions_valides = array('jpg','jpeg','gif','png');
echo $_FILES['image']['name'];
echo $_FILES['image']['type'];
echo $_FILES['image']['size'];
echo $_FILES['image']['error'];
echo $_FILES['image']['tmp_name'];
$exention_image = strtolower(substr(strchr($_FILES['image']['name'], '.'),1));

if($_FILES['image']['error'] > 0){
    $erreur = 1;
}
if($_FILES['image']['size']> $maxsize){
    $erreur = 2;
}

if( in_array($exention_image,$extensions_valides) && erreur == 0) {
    $nom = md5(uniqid(rand(),true));
    $nomImage = "{$nom}.{$exention_image}";
    if (move_uploaded_file($_FILES['image']['tmp_name'],$nomImage) == TRUE){
        $objetInfos['url_photo'] = $nomImage;
    }
    $newobjet = new Objet();
    $objetInfos['nom_objet'] = filter_input(INPUT_POST, 'nom');
    $objetInfos['description_objet'] = filter_input(INPUT_POST, 'description');
    $objetInfos['id_type'] = filter_input(INPUT_POST, 'categorie');
    $objetInfos['prix'] = filter_input(INPUT_POST, 'prix');
    $objetInfos['prix_caution'] = filter_input(INPUT_POST, 'prix_caution');
    $objetInfos['id_utilisateur'] = $_SESSION['IDUSER'];
    $test = $newobjet->insert($objetInfos);
}
header('Location:../index.php');