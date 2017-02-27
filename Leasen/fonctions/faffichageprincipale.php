<?php
/**
 * @param int $connexion état de la connection 1 :connecté 0:deconnecté
 */
function affichageprincipale($connexion)
{
    if ($connexion == 1) {
        ?>
        <div class="parallax-container">
            <div class="parallax"><img class="responsive-img" src="image/OB82160.jpg">
            </div>
        </div>
        <div class="grey lighten-3">
        <div class="row">
            <div>
                <br><h5 class="center-align grey-text text-darken-4">Annonces les plus récentes</h5>
            </div>
        </div>
        <br>
        <?php
        $info = array();
        $info['id_utilisateur'] = isset($_SESSION['IDUSER'])?$_SESSION['IDUSER']:0;
        $test = new Recherche();
        $res = $test->effectueRecherche($info,4);
        foreach ($res as $k => $v) {
        ?>
        <div class="row">
        <div class="col s3 ">
            <div class="white  grey-text  text-darken-1">
                <br>
                <h6 class="center-align">
                    <?php
                    echo $v["nom_objet"];
                    echo $v["description_objet"];
                    ?>
                </h6>
                <br>
                <form method="post" action="../pages/detailobjet.php">
                    <div id="hide" style="display:none">
                        <label for="id_objet"></label>
                        <input type="number" id="id_objet" name="id_objet" value="<?php echo $v["id_objet"]; ?>"/>
                    </div>
                    <input type="submit" value="Voir en détails" >
                </form>
                <br>
            </div>
        </div>
        <?php
        } // fin du foreach
        ?>
        <div class="row">
            <div class="col s4 offset-s4">
                <a href="../pages/listeObjets.php" class="waves-effect waves-light deep-orange white-text btn">Explorer
                    toutes les annonces<i class="material-icons right">add</i></a>
            </div>
        </div>
        <?php
        include "fonctions/footer.php";
        footer();
    } // fin du if
} // fin de la fonction
?>