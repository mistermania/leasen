<?php
session_start();
if(!isset($_SESSION['USER']) || !isset($_SESSION['IDUSER']))
{
    header('Location:index.php');
}

require('class/Autoloader.php');
Autoloader::register();

//print_r($_POST);
echo '<br>';
$newobjet = new Objet();

$objetInfos['id_objet'] =  filter_input(INPUT_POST, 'id_objet');

$res=$newobjet->find($objetInfos);

foreach ($res as $k =>$v)
{
        echo  "<h1>".$v["nom_objet"]."</h1><br/>";
        echo "Description:<br/>".$v["description_objet"]."<br/>";
        echo "Caution:".$v["prix_caution"]."<br/>";
        echo "Prix:".$v["prix"]."<br/>";

}
?>

