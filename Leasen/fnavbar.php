
<?php



function navbarcall($connexion,$pageactive){
     
   
    
    echo '
        <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper white">
            
            
            <a href="#" class="brand-logo cyan-text text-darken-4"> Leasen</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">';
    
   
  
    if($connexion ==1){
       
        if($pageactive==1){
            echo 
            ' <li class="active  "><a href="index.php" class="cyan-text text-darken-4">Accueil</a></li> ' ;
        }
        else{
            echo ' <li><a href="index.php" class="amber-text text-darken-2">Accueil</a></li>';
        }
        if($pageactive==2){
            echo 
             ' <li class=" active"><a href="objet.php" class="cyan-text text-darken-4">Les objets</a></li>';
            
        }
        else{
            echo ' <li><a href="objet.php" class="amber-text text-darken-2">Les objets</a></li>';
        }
        if($pageactive==3){
            echo '<li class="active"><a href="listedemandes.php" class="cyan-text text-darken-4>Les demandes</a></li>' ;
        }
        else{
            echo ' <li><a href="listedemandes.php" class="amber-text text-darken-2">Les demandes</a></li>';
        }
        if($pageactive==4){
            echo '<li class="active"><a href="propositionobjet.php class="cyan-text text-darken-4"">Proposer un objet</a></li>' ;
        }
        else{
            echo '<li><a href="propositionobjet.php" class="amber-text text-darken-2"> Proposer un objet</a></li>';
        }
        if($pageactive==5){
            echo '<li class="active"><a href="fairedemande.php" class="cyan-text text-darken-4">Faire une demande</a></li>' ;
        }
        else{
            echo '<li><a href="fairedemande.php" class="amber-text text-darken-2"> Faire une demande </a></li>';
        }
        if($pageactive==6){
            echo '
            <li class="active"><a href="guide.php" class="cyan-text text-darken-4">Guide</a></li>
            ' ;
        }
        else{
            echo '
            <li><a href="guide.php" class="amber-text text-darken-2"> Guide</a></li>';
        }
        if($pageactive==7){
                    
             echo '
            <li><a href="moncompte.php" class="cyan-text text-darken-4"> Mon compte</a></li>
            ';
           
        }
        else{
             echo'<li><a class="amber-text text-darken-2 dropdown-button" href="#" data-activates="dropdown1">Mon compte<i class="material-icons right">arrow_drop_down</i></a></li>';
              
           //menu déroulant dans l'onglet moncompte
           echo'
               
            
              <ul id="dropdown1" class="dropdown-content">
                <li><a href="#!">Modifier mes informations</a></li>
                <li class="divider"></li>
                <li><a href="#!">Déconnexion</a></li>
              </ul>  ';
          
        } //fermeture else
    
        
    }// fermeture du test de la connexion
    else{
        echo '<li><a href="index.php">Accueil</a></li>
              <li><a href="inscription.php">Inscription</a></li>
              <li><a href="connexion.php">Connexion</a></li> ';
    }//fermeture else
     
    //fin barre de navigation
    echo '  </ul>
            </div>
        </nav>
        </div> '; 
    
} // fin de la fonction

    
?>

