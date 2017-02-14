<?php
/**
 * @param int $connexion état de la connection 1 :connecté 0:deconnecté
 */
function affichageprincipale($connexion)
{
    if ($connexion == 1) {
        //image page d'accueil avec l'effet parallax + barre de recherche (formulaire) + texte
        ?>

            
        <div class="parallax-container">
            <div class="parallax"><img class="responsive-img" src="image/OB82160.jpg">
            </div>
        </div>
        
            <div class="grey lighten-3">
         
          <div class="row">
              
            <div>
                <br>
                <span class="grey-text text-darken-4 "><h5 class="center-align">Annonces les plus récentes</h5> </span>
            </div>
          </div>
            <br>
            <!--  // 4 cases pour les annonces récentes avec bouton pour aller sur la page de l'article-->
            
            <div class="row">
                <div class="col s3 ">
                    <div class="white  grey-text  text-darken-1">
                        <br>
                        <h6 class="center-align"> Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Proin lacinia interdum augue, at pellentesque risus tempor et.
                            Duis iaculis enim id accumsan sagittis. Mauris ante turpis,
                            rhoncus sit amet condimentum ac, mattis eu magna.
                            Maecenas lobortis egestas iaculis. Curabitur ultricies non est eu ultrices.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos. Nulla ac mi at nisi porta fringilla.
                            Quisque nec ante auctor, hendrerit ex ac, placerat risus. </h6>
                        <br>
                        <a class="col s8 offset-s2 waves-effect waves-light deep-orange btn">En savoir plus<i
                                    class="material-icons right">info</i></a>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="col s3">
                    <div class="white  grey-text  text-darken-1">
                        <br>
                        <h6 class="center-align"> Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Proin lacinia interdum augue, at pellentesque risus tempor et.
                            Duis iaculis enim id accumsan sagittis. Mauris ante turpis,
                            rhoncus sit amet condimentum ac, mattis eu magna.
                            Maecenas lobortis egestas iaculis. Curabitur ultricies non est eu ultrices.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos. Nulla ac mi at nisi porta fringilla.
                            Quisque nec ante auctor, hendrerit ex ac, placerat risus. </h6>
                        <br>
                        <a class="col s8 offset-s2 waves-effect waves-light deep-orange btn">En savoir plus<i
                                    class="material-icons right">info</i></a>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="col s3">
                    <div class="white  grey-text  text-darken-1">
                        <br>
                        <h6 class="center-align"> Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Proin lacinia interdum augue, at pellentesque risus tempor et.
                            Duis iaculis enim id accumsan sagittis. Mauris ante turpis,
                            rhoncus sit amet condimentum ac, mattis eu magna.
                            Maecenas lobortis egestas iaculis. Curabitur ultricies non est eu ultrices.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos. Nulla ac mi at nisi porta fringilla.
                            Quisque nec ante auctor, hendrerit ex ac, placerat risus. </h6>
                        <br>
                        <a class="col s8 offset-s2 waves-effect waves-light col  deep-orange btn">En savoir plus<i
                                    class="material-icons right">info</i></a>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="col s3 ">
                    <div class="white  grey-text  text-darken-1">
                        <br>
                        <h6 class="center-align"> Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Proin lacinia interdum augue, at pellentesque risus tempor et.
                            Duis iaculis enim id accumsan sagittis. Mauris ante turpis,
                            rhoncus sit amet condimentum ac, mattis eu magna.
                            Maecenas lobortis egestas iaculis. Curabitur ultricies non est eu ultrices.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos. Nulla ac mi at nisi porta fringilla.
                            Quisque nec ante auctor, hendrerit ex ac, placerat risus. </h6>
                        <br>
                        <a class=" col s8 offset-s2 waves-effect waves-light deep-orange  btn">En savoir plus<i
                                    class="material-icons right">info</i></a>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
            
            <!--// fermeture <div class="row"> des cases pour les annonces récentes
            //saut de ligne + bouton renvoyer vers la page des annonces des objets en location-->
            <br>
            <div class="row">
                <div class="col s4 offset-s4">
                    <a href="./pages/listeObjets.php" class="waves-effect waves-light deep-orange white-text btn">Explorer toutes les
                        annonces<i class="material-icons right">add</i></a>
                </div>
            </div>
           
            <!--//footer-->
            <footer class="page-footer cyan darken-1">
                <div class="container cyan darken-1">
                    <div class="row">
                        
                        <div class="col l6 s12">
                           
                            <p class="grey-text text-lighten-4">You can use rows and columns here to organize your
                                footer content.</p>
                        </div>
                     <!--   <div class="col l4 offset-l2 s12">
                            <h5 class="white-text">Links</h5>
                            <ul>
                                <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                                <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="container">
                        © 2017 LEASEN Tous droits réservés.
                        
                    </div>
                </div>
            </footer>
        <?php
    } // fin du if
} // fin de la fonction
