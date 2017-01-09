
<?php
$sep=array();
function navbarcall($connexion,$pageactive){
    if($pageactive==1)
    {
    	$sep[0]='pages/';
    	$sep[1]='fonctions/';
    	$sep[2]='';
    }else{
    $sep[0]='';
    $sep[1]='../fonction/';
    $sep[2]='../';
    }
    ?>
        <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper white">
            <a href="#" class="brand-logo cyan-text text-darken-4"> Leasen</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">'
                <?php
    if($connexion ==1){
        /*tableau contenant les nom des pages, le nom du fichier, numero page*/
        $page=array('Accueil'=>array('../index.php',1),'Les objets'=>array('listeObjets.php',2),'Les demandes'=>array('lesdemandes.php',3),'Proposer un objet'=>array('posterobjet.php',4),'Faire une demande'=>array('fairedemande.php',5),'Guide'=>array('guide.php',6));
      foreach($page as $k =>$v)
      {
      if($pageactive==$v[1])
      {
       echo '<li class="active  "><a href="'.$sep[0].$v[0].'" class="cyan-text text-darken-4">'.$k.'</a></li> ';
      }else{
      echo ' <li><a href="'.$sep[0].$v[0].'" class="amber-text text-darken-2">'.$k.'</a></li>';
      }
      }

      if($pageactive==7){
                    
             echo '
            <li><a href="moncompte.php" class="cyan-text text-darken-4"> Mon compte</a></li>
            ';
           
        }
        else{
            ?>
             <li><a class="amber-text text-darken-2 dropdown-button" href="#" data-activates="dropdown1">Mon compte <i class="material-icons right">arrow_drop_down</i></a></li>
              
           <!--menu déroulant dans l'onglet moncompte -->

            
              <ul id="dropdown1" class="dropdown-content">
                <li><a href="#!">Modifier mes informations</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo $sep[1];?>deco.php">Déconnexion</a></li>
              </ul>
          <?php
        } //fermeture else
    
        
    }// fermeture du test de la connexion
    else{
        echo '<li><a href="'.$sep[2].'index.php" class="amber-text text-darken-2">Accueil</a></li>
              <li><a href="'.$sep[0].'inscription.php" class="amber-text text-darken-2">Inscription</a></li>
              <li><a href="'.$sep[0].'connexion.php" class="amber-text text-darken-2">Connexion</a></li> ';
    }//fermeture else
   
    //fin barre de navigation
    echo '  </ul>
            </div>
        </nav>
        </div> '; 
} // fin de la fonction    
?>

