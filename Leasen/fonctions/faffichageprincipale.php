<?php

/**
 * @param int $connexion état de la connection 1 :connecté 0:deconnecté
 */
function affichageprincipale($connexion) {
    if ($connexion == 1) {
        ?>
        <div class="parallax-container">
            <div class="parallax"><img class="imageindex" src="image/unnamed.jpg">
            </div>
        </div>
        <div class="grey lighten-3">
            <div class="row">
                <div>
                    <br><h5 class="center-align grey-text text-darken-4">Annonces les plus récentes</h5>
                </div>
            </div>
            <?php
            $info = array();
            $info['id_utilisateur'] = isset($_SESSION['IDUSER']) ? $_SESSION['IDUSER'] : 0;
            $test = new Recherche();
            $res = $test->effectueRecherche($info, 3);
            foreach ($res as $k => $v) {
                ?>
                <div class="row">
                    <div class="col s12 m6 l4"><br/>
                        <div class="white grey-text text-darken-4">
                            <br/>
                            <h6 class="center-align">
                                <?php
                                echo $v["nom_objet"];
                                echo '</br>';
                                echo $v["description_objet"];
                                ?>
                            </h6>
                            <br>
                            <form method="post" action="pages/detailobjet.php">
                                <div id="hide" style="display:none">
                                    <label for="id_objet"></label>
                                    <input type="number" id="id_objet" name="id_objet" value="<?php echo $v["id_objet"]; ?>"/>
                                </div>
                                <input type="submit" class="col s6 offset-s3 deep-orange btn" value="Voir plus" ><br/><br/>
                            </form>
                            <br/>
                        </div>
                    </div>
                    <?php
                } // fin du foreach
                ?>

            </div>
            <div class="row">
                <a href="pages/listeObjets.php" class="waves-effect waves-light deep-orange white-text btn col l4 offset-l4 m4 offset-m4 s4 offset-s4 ">Explorer toutes les annonces<i class="material-icons right">add</i></a>
            </div>

        </div>
        <?php
    } else {
        ?>
        <article class="col s8 offset-s2 ">
            <div class="parallax-container">
                <div class="parallax"><img class="imageindex" src="image/unnamed.jpg">
                </div>
            </div>
            <section>
                <br><br>
                <div class="container white ">
                    <br>
                    <h4 class="center-align deep-orange-text "> Qu'est ce que Leasen?</h4>
                    <p class="center-align grey-text text-darken-4">
                        Besoin d'une caméra pour tourner votre projet média ?
                        Comment rentabiliser facilement votre appareil à raclette alors que vous ne l'utilisez pas tous les
                        jours?
                        Une solution, le prêt ou location d'objet entre étudiant de l'ISEN Toulon ! <br> <br>
                    </p>
                    <p class="center-align grey-text text-darken-4">
                        Leasen est un site internet d'objets permettant aux étudiant de l'ISEN Toulon de mettre en location,
                        de prêter ou de louer des objets de différents types
                        : petit electroménager, bricolage, hightech, sport... <br>
                        </br>
                        </br>
                    </p>
                </div>
            </section>
        </article>

        <?php
    }
}

// fin de la fonction
?>
        