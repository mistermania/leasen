<?php
require('../class/Autoloader.php');
Autoloader::register(1);
$info = array();
$info['chaine'] = filter_input(INPUT_POST, 'recherche');
$info['id_type'] = filter_input(INPUT_POST, 'categorie');
$info['date_debut'] = filter_input(INPUT_POST, 'date');
$info['duree'] = filter_input(INPUT_POST, 'duree');
$test = new Recherche();
/** @var mixed $res */
$res = $test->effectueRecherche($info);
?>
<table border="1" class="responsive-table bordered white ">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Caution</th>
        <th>Prix</th>
        <th>Détails</th>
    </tr>
    </thead>
    <?php

    if($res==2){
        echo 'date invalides';
    }else {
        foreach ($res as $k => $v) {
            ?>
            <tr>
                <td> <?php echo $v["nom_objet"]; ?> </td>
                <td> <?php echo $v["description_objet"]; ?> </td>
                <td> <?php echo $v["prix_caution"]; ?> </td>
                <td> <?php echo $v["prix"]; ?> </td>
                
                <td>
                    <form method="post" action="../pages/detailobjet.php">
                        <?php
                        echo '<input type="submit" class="col s6 offset-s3 deep-orange btn" value="Voir plus" >';

                        ?>
                        <div id="hide" style="display:none">
                            <label for="id_objet"></label>
                            <input type="number" id="id_objet" name="id_objet" value="<?php echo $v["id_objet"]; ?>"/>
                            <label for="duree"></label>
                            <input type="number" id="duree" name="duree" value="<?php echo $info['duree']; ?>"/>
                            <label for="date"></label>
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
