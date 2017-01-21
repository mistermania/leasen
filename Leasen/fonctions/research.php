<?php
require('../class/Autoloader.php');
Autoloader::register(1);
$info=array();
$info['chaine'] = filter_input(INPUT_POST,'recherche');
$info['id_type'] =filter_input(INPUT_POST,'categorie');
$info['date_debut'] = filter_input(INPUT_POST,'date');
$info['duree']=filter_input(INPUT_POST,'duree');
$test= new Recherche();
$res=$test->effectueRecherche($info);
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
                <?php
								if(!empty($info['duree']) AND !empty($info['duree']))
								{
								echo '<input type="submit" value="Louer" >';
							}else {
								echo '<input type="submit" value="fiche de l\'objet" >';
							}
								?>

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
    ?>
</table>
