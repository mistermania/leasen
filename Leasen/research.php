<?php
require('class/Autoloader.php');
Autoloader::register();
$info=array();
$info['chaine'] = $_POST['recherche'];
$info['id_type'] = $_POST['categorie'];
$info['date_debut'] = $_POST['date'];
$info['duree']=$_POST['duree'];
$test= new Recherche();
$res=$test->effectueRecherche($info);
//print_r($res);
?>
<table border="1">
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Caution</th>
        <th>Prix</th>

    </tr>
    <?php
    foreach ($res as $k =>$v)
    {
    ?>
    <tr>
        <td> <?php echo  $v["nom_objet"]; ?> </td>
        <td> <?php echo $v["description_objet"]; ?> </td>
        <td> <?php echo $v["prix_caution"]; ?> </td>
        <td> <?php echo $v["prix"]; ?> </td>
        <td>
            <form method="post" action="./detailobjet.php">
                <input type="submit" value="Louer" >
                <?php echo $v["id_objet"]; ?>
                <div id="hide" style="display:none">
                    <input type="number" id="id_objet" name="id_objet" value="<?php echo $v["id_objet"]; ?>"/>
                </div>
            </form>
        </td>

    </tr>

    <?php
    }
    ?>








