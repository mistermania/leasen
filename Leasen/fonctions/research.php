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

<table border="1" class="responsive-table striped">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Caution</th>
        <th>Prix</th>

    </tr>
    </thead>
    <?php
    $objetAffiche=array();
    foreach ($res as $k =>$v)
    {
    if(!in_array($v['id_objet'],$objetAffiche))
    {
        $objetAffiche[]=$v['id_objet'];
    ?>
    <tr>
        <td> <?php echo  $v["nom_objet"]; ?> </td>
        <td> <?php echo $v["description_objet"]; ?> </td>
        <td> <?php echo $v["prix_caution"]; ?> </td>
        <td> <?php echo $v["prix"]; ?> </td>
        <td>
            <form method="post" action="./detailobjet.php">
                <input type="submit" value="Louer" >

                <div id="hide" style="display:none">
                    <input type="number" id="id_objet" name="id_objet" value="<?php echo $v["id_objet"]; ?>"/>
                    <input type="number" id="duree" name="duree" value="<?php echo $info['duree']; ?>"/>
                    <input type="date" id="date" name="date" value="<?php echo $info['date_debut']; ?>"/>
                </div>
            </form>
        </td>

    </tr>

    <?php
    }
    }
    ?>
</table>






