<?php
session_start();
if (!isset($_SESSION['USER']) || !isset($_SESSION['IDUSER'])) {
    header('Location:index.php');
}
require('../class/Autoloader.php');
Autoloader::register(1);
$maxsize = 1000000;
$erreur = 0;
$extensions_valides = array('jpg', 'jpeg', 'gif', 'png');

$exention_image = strtolower(substr(strchr($_FILES['image']['name'], '.'), 1));
$name = $_FILES["image"]["name"];
$uploads_dir = '/image';

if ($_FILES['image']['error'] > 0) {
    $erreur = 1;
}
if ($_FILES['image']['size'] > $maxsize) {
    $erreur = 2;
}

if (in_array($exention_image, $extensions_valides) && $erreur == 0) {
    if (move_uploaded_file($_FILES['image']['tmp_name'], "../image/imgObj/$name") == TRUE) {

    }
    $objetInfos['url_photo'] = "/image/imgObj/$name";
    echo $objetInfos['url_photo'] . '</br> ';
}

$objetInfos['nom_objet'] = filter_input(INPUT_POST, 'nom');
$objetInfos['description_objet'] = filter_input(INPUT_POST, 'description');
$objetInfos['id_type'] = filter_input(INPUT_POST, 'categorie');
$objetInfos['prix'] = filter_input(INPUT_POST, 'prix');
$objetInfos['prix_caution'] = filter_input(INPUT_POST, 'prix_caution');
$objetInfos['id_utilisateur'] = $_SESSION['IDUSER'];

$newobjet = new Objet();
$res = $newobjet->insert($objetInfos);
echo 'resultat ' . $res;

//header('Location:../index.php');