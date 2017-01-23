<?php
session_start();
if (!isset($_SESSION['USER']) || !isset($_SESSION['IDUSER'])) {
    header('Location:../index.php');
}

require('../class/Autoloader.php');
Autoloader::register(1);
?>
<html>
<head>

</head>
<body>
<?php
//print_r($_POST);

$newobjet = new Objet();
$objetInfos['id_objet'] = filter_input(INPUT_POST, 'id_objet');
echo $objetInfos['id_objet'];
$res = $newobjet->find($objetInfos);

foreach ($res as $k => $v) {
    echo "<h1>" . $v["nom_objet"] . "</h1><br/>";
    echo "Description:<br/>" . $v["description_objet"] . "<br/>";
    echo "Caution:" . $v["prix_caution"] . "<br/>";
    echo "Prix:" . $v["prix"] . "<br/>";

}
	$infosLoc['id_objet'] = filter_input(INPUT_POST, 'id_objet');
	$infosLoc['id_utilisateur'] = $_SESSION['IDUSER'];
	$infosLoc['date_debut'] = filter_input(INPUT_POST, 'date');
	$duree=filter_input(INPUT_POST, 'duree');
	if (!empty($infosLoc['date_debut']) AND !empty($duree)) {

	//creation d'un ojet datetime pour permettre l'ajout de la duree
	$date = new DateTime($infosLoc['date_debut']);
	// duréee transformé en un objet date interval ( durée en jour)
	$duree = new DateInterval('P' . $duree . 'D');
	$infosLoc['date_fin'] = $date->add($duree)->format('Y-m-d');
	print_r($infosLoc);
?>
<form method="post" action="../fonctions/confirmerLocation.php">
     <div id="hide" style="display:none">
         <label for="id_objet"></label>
        <input type="number" id="id_objet" name="id_objet" value="<?php echo $infosLoc["id_objet"]; ?>"/>
         <label for="date_fin"></label>
        <input type="date" id="date_fin" name="date_fin" value="<?php echo $infosLoc['date_fin']; ?>"/>
         <label for="date_debut"></label>
        <input type="date" id="date_debut" name="date_debut" value="<?php echo $infosLoc['date_debut']; ?>"/>

    </div>
    <input type="submit" value="Envoyer demmande de location" >
</form>
<?php } ?>
</body>
<?php
?>
