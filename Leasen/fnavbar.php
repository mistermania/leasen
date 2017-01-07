<?php



function navbarcall($connexion,$pageactive){
    echo '<nav>
            <div class="nav-wrapper blue darken-2">
              <a href="#" class="brand-logo center">Logo</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">';
    if($connexion ==1){
        if($pageactive==1){
            echo '<li class="active"><a href="index.php">Accueil</a></li>' ;
        }
        else{
            echo '  <li><a href="index.php">Accueil</a></li>';
        }
        if($pageactive==2){
            echo '<li class="active"><a href="demande.php">Demandes</a></li>' ;
        }
        else{
            echo '  <li><a href="demande.php">Demandes</a></li>';
        }
        if($pageactive==3){
            echo '<li class="active"><a href="propositions.php">Propositions</a></li>' ;
        }
        else{
            echo '  <li><a href="propositions.php">Propositions</a></li>';
        }
        if($pageactive==4){
            echo '<li class="active"><a href="deco.php">Deconnexion</a></li>' ;
        }
        else{
            echo '<li><a href="deco.php">Deconnexion</a></li>';
        }
    }
    else{
        echo '<li><a href="index.php">Accueil</a></li>
            <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                ';
    }
    echo '</ul>
              
            </div>
        </nav>';
}

?>

