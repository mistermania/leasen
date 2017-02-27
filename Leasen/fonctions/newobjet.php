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
print_r($_FILES);
echo '</br>';
/*if(isset($_FILES['image'])) {
    echo $_FILES['image']['name'];
    echo $_FILES['image']['type'];
    echo $_FILES['image']['size'];
    echo $_FILES['image']['error'];
    echo $_FILES['image']['tmp_name'];
}else {
    echo "bonjour</br>";
    php mailer
}*/
$name = $_FILES["image"]["name"];
$exention_image = strtolower(substr(strchr($_FILES['image']['name'], '.'), 1));
$uploads_dir = '../image/imgObjet';
if ($_FILES['image']['error'] > 0) {
    $erreur = 1;
}
if ($_FILES['image']['size'] > $maxsize) {
    $erreur = 2;
}
$newobjet = new Objet();

if (in_array($exention_image, $extensions_valides) && $erreur == 0) {
    $nom = md5(uniqid(rand(), true));
    $nomImage = "{$nom}.{$exention_image}";
    if (move_uploaded_file($_FILES['image']['tmp_name'], "$uploads_dir/$name") == TRUE) {
        $objetInfos['url_photo'] = $nomImage;

    }
}

echo $objetInfos['url_photo'] . '</br> ';
$objetInfos['nom_objet'] = filter_input(INPUT_POST, 'nom');
$objetInfos['description_objet'] = filter_input(INPUT_POST, 'description');
$objetInfos['id_type'] = filter_input(INPUT_POST, 'categorie');
$objetInfos['prix'] = filter_input(INPUT_POST, 'prix');
$objetInfos['prix_caution'] = filter_input(INPUT_POST, 'prix_caution');
$objetInfos['id_utilisateur'] = $_SESSION['IDUSER'];
$test = $newobjet->insert($objetInfos);
echo 'resultat ' . $test;

//header('Location:../index.php');