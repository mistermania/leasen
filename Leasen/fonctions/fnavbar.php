<?php
$sep = array();

/**
 * @param int $connexion état de la connection 1 : connecté ; 0 : deconnecté
 * @param int $pageactive numero de la page active (voir l'array ligne 38
 */
function navbarcall($connexion, $pageactive) {
    /* tableau utilise pour prefixer les noms de fichier afin de pointer sur les bon dossiers */
    if ($pageactive == 1) {
        /* prefixe utilisé si nous somme dans l'index */
        //pour acceder au dossier page
        $sep[0] = 'pages/';
        //pour acceder au dossier fonction
        $sep[1] = 'fonctions/';
        //pour acceder a la racine
        $sep[2] = '';
    } else {
        //prefixe utilisé dans le dossier page
        //pour acceder au dossier page
        $sep[0] = '';
        //pour acceder au dossier fonction
        $sep[1] = '../fonctions/';
        //pour acceder a la racine
        $sep[2] = '../';
    }
    ?>

    <nav>
        <div class="nav-wrapper cyan">
            <a href="../index.php" class="brand-logo white-text">  Leasen</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a> 

            <?php
            if ($connexion == 1) {
                /* tableau contenant les nom des pages, le nom du fichier, numero page */
                $page = array('Accueil' => array('../index.php', 1), 'Les objets' => array('listeObjets.php', 2), 'Proposer un objet' => array('posterobjet.php', 3), 'Guide' => array('guide.php', 4));
                ?>
                <!-- Pour l'affichage sur téléphone et petite tablette -->
                <ul id="mobile-demo" class="side-nav">
                    <?php
                    foreach ($page as $k => $v) {
                        if ($pageactive == $v[1]) {

                            echo '<li class="bold"><a href="' . $sep[0] . $v[0] . '" class="waves-effect waves-cyan cyan-text">' . $k . '</a></li> ';
                        } else {
                            echo '<li class="bold"><a href="' . $sep[0] . $v[0] . '" class="waves-effect waves-cyan grey-text text-darken-3">' . $k . '</a></li> ';
                        }
                    }
                    if ($pageactive == 5) {
                        ?>
                    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
                        <li class="cyan-text"><a class="collapsible-header  waves-effect waves-cyan">Mon compte</a>
                            <div class="collapsible-body">
                                <!--menu déroulant dans l'onglet moncompte -->
                                <ul>
                    <?php echo '<li><a href="' . $sep[0] . 'moncompte.php">Modifier mes informations</a></li>'; ?>
                                    <li class="divider"></li>
                                    <?php echo '<li><a href="' . $sep[0] . 'mesannonces.php"> Mes annonces </a></li>'; ?>
                                    <li class="divider"></li>
                                    <?php echo '<li><a href="' . $sep[0] . 'historiquelocation.php">Historique de mes locations</a></li>'; ?>
                                    <li class="divider"></li>
                                    <?php echo '<li><a href="' . $sep[0] . 'message.php">Mes messages</a></li>'; ?>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo $sep[1]; ?>deco.php">Déconnexion</a></li>
                                </ul>
                            </div></li>
        </ul>
                    </li>
                            
                           
            <?php } else {
            ?>
                        <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
                        <li class="grey-text"><a class="collapsible-header  waves-effect waves-cyan">Mon compte</a>
                            <div class="collapsible-body">
                                <!--menu déroulant dans l'onglet moncompte -->
                                <ul>
            <?php echo '<li><a href="' . $sep[0] . 'moncompte.php">Modifier mes informations</a></li>'; ?>
                                    <li class="divider"></li>
                                    <?php echo '<li><a href="' . $sep[0] . 'mesannonces.php"> Mes annonces </a></li>'; ?>
                                    <li class="divider"></li>
                                    <?php echo '<li><a href="' . $sep[0] . 'historiquelocation.php">Historique de mes locations</a></li>'; ?>
                                    <li class="divider"></li>
                                    <?php echo '<li><a href="' . $sep[0] . 'message.php">Mes messages</a></li>'; ?>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo $sep[1]; ?>deco.php">Déconnexion</a></li>
                                </ul>
                            </div></li>
        </ul></li> <?php
                    }
                    ?>
                </ul>
                
                <!-- Pour l'affichage sur ordinateur et grande tablette -->
                <ul class=" right hide-on-med-and-down">
        <?php
        foreach ($page as $k => $v) {
            if ($pageactive == $v[1]) {
                ?>

                            <!-- affichage pour la page active -->
                            <?php echo '<li class="active "><a href="' . $sep[0] . $v[0] . '" class="grey-text text-darken-3">' . $k . '</a></li>'; ?>

                            <?php } else {
                            ?>

                            <!-- affichage pour les autres pages -->
                            <?php echo '<li><a href="' . $sep[0] . $v[0] . '" class="<white-text">' . $k . '</a></li>'; ?>

                            <?php
                        }
                    }

                    if ($pageactive == 5) {
                        ?>

                        <li><a class="grey-text text-darken-3 dropdown-button" href="#" data-activates="dropdown1">Mon compte <i class="material-icons right">arrow_drop_down</i></a></li>

                        <!--menu déroulant dans l'onglet moncompte -->
                        <ul id="dropdown1" class="dropdown-content">
                            <?php echo '<li><a href="' . $sep[0] . 'moncompte.php">Modifier mes informations</a></li>'; ?>
                            <li class="divider"></li>
                            <?php echo '<li><a href="' . $sep[0] . 'mesannonces.php"> Mes annonces </a></li>'; ?>
                            <li class="divider"></li>
                            <?php echo '<li><a href="' . $sep[0] . 'historiquelocation.php">Historique de mes locations</a></li>'; ?>
                            <li class="divider"></li>
                            <?php echo '<li><a href="' . $sep[0] . 'message.php">Mes messages</a></li>'; ?>
                            <li class="divider"></li>
                            <li><a href="<?php echo $sep[1]; ?>deco.php">Déconnexion</a></li>
                        </ul>

                        <?php
                    } else {
                        ?>

                        <li><a class="white-text dropdown-button" href="#" data-activates="dropdown1">Mon compte <i class="material-icons right">arrow_drop_down</i></a></li>

                        <!--menu déroulant dans l'onglet moncompte -->
                        <ul id="dropdown1" class="dropdown-content">
                            <?php echo '<li><a href="' . $sep[0] . 'moncompte.php">Modifier mes informations</a></li>'; ?>
                            <li class="divider"></li>
                            <?php echo '<li><a href="' . $sep[0] . 'mesannonces.php"> Mes annonces </a></li>'; ?>
                            <li class="divider"></li>
                            <?php echo '<li><a href="' . $sep[0] . 'historiquelocation.php">Historique de mes locations</a></li>'; ?>
                            <li class="divider"></li>
                            <?php echo '<li><a href="' . $sep[0] . 'message.php">Mes messages</a></li>'; ?>
                            <li class="divider"></li>
                            <li><a href="<?php echo $sep[1]; ?>deco.php">Déconnexion</a></li>
                        </ul>


                        <?php
                    }
                    //fermeture else
                    ?>
                </ul>

                <?php
            }// fermeture du test de la connexion
            else {
                ?>
                <ul class=" right hide-on-med-and-down"> <?php
                    echo '<li><a href="' . $sep[2] . 'index.php" class="white-text">Accueil</a></li>
              <li><a href="' . $sep[0] . 'inscription.php" class="white-text">Inscription</a></li>
              <li><a href="' . $sep[0] . 'connexion.php" class="white-text">Connexion</a></li> ';
                    ?>
                </ul>
                
                <ul id="mobile-demo" class="side-nav"> <?php
                    echo '<li class="bold"><a href="' . $sep[2] . 'index.php" class="cyan-text">Accueil</a></li>
              <li class="bold"><a href="' . $sep[0] . 'inscription.php" class="grey-text text-darken-3">Inscription</a></li>
              <li class="bold"><a href="' . $sep[0] . 'connexion.php" class="grey-text text-darken-3">Connexion</a></li> ';
                ?>    
                </ul>
                <?php
            }//fermeture else
            //fin barre de navigation
            ?>

        </div>
    </nav>

<?php
}

// fin de la fonction
?>