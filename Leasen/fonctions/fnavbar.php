<?php
$sep = array();
/**
 * @param int $connexion état de la connection 1 : connecté ; 0 : deconnecté
 * @param int $pageactive numero de la page active (voir l'array ligne 38
 */
function navbarcall($connexion, $pageactive)
{
    /*tableau utilise pour prefixer les noms de fichier afin de pointer sur les bon dossiers*/
    if($pageactive==1)
    {
        /*prefixe utilisé si nous somme dans l'index*/
        //pour acceder au dossier page
    	$sep[0]='pages/';
        //pour acceder au dossier fonction
    	$sep[1]='fonctions/';
        //pour acceder a la racine
    	$sep[2]='';
    }else{
        //prefixe utilisé dans le dossier page
        //pour acceder au dossier page
    $sep[0]='';
        //pour acceder au dossier fonction
    $sep[1]='../fonctions/';
        //pour acceder a la racine
    $sep[2]='../';
    }
    ?>
        <div class="navbar-fixed">
        <nav>
            
            <div class="nav-wrapper cyan">
            <a href="../index.php" class="brand-logo white-text">  Leasen</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php
    if($connexion ==1){
        /*tableau contenant les nom des pages, le nom du fichier, numero page*/
        $page=array('Accueil'=>array('../index.php',1),'Les objets'=>array('listeObjets.php',2),'Proposer un objet'=>array('posterobjet.php',3),'Guide'=>array('guide.php',4));
      foreach($page as $k =>$v)
      {
      if($pageactive==$v[1])
      {
          //affichage pour la page active
       echo '<li class="active  "><a href="'.$sep[0].$v[0].'" class="grey-text text-darken-3">'.$k.'</a></li> ';
      }else{
          //affichage pour les autres pages
      echo ' <li><a href="'.$sep[0].$v[0].'" class="<white-text">'.$k.'</a></li>';
      }
      }
      if($pageactive==5){
             echo '<li><a href="'.$sep[0].'moncompte.php" class="grey-text text-darken-3"> Mon compte</a></li>';
        }
        else{
            ?>

             <li><a class="white-text dropdown-button" href="#" data-activates="dropdown1">Mon compte <i class="material-icons right">arrow_drop_down</i></a></li>
             
             
           <!--menu déroulant dans l'onglet moncompte -->
              <ul id="dropdown1" class="dropdown-content">
                <li><a href="moncompte.php">Modifier mes informations</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo $sep[1];?>deco.php">Déconnexion</a></li>
              </ul>
          <?php
        } //fermeture else
    }// fermeture du test de la connexion
    else{
        echo '<li><a href="'.$sep[2].'index.php" class="white-text">Accueil</a></li>
              <li><a href="'.$sep[0].'inscription.php" class="white-text">Inscription</a></li>
              <li><a href="'.$sep[0].'connexion.php" class="white-text">Connexion</a></li> ';
    }//fermeture else
    //fin barre de navigation
    echo '  </ul>
            </div>
        </nav>
        </div> ';
} // fin de la fonction
?>