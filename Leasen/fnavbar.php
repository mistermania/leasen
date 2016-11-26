<?php



function navbarcall($connexion){
    echo '<nav>
            <div class="nav-wrapper blue darken-2">
              <a href="#" class="brand-logo center">Logo</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">';
    if($connexion ==1){
        echo '  <li><a href="index.php">Accueil</a></li>
                <li><a href="demande.php">Demandes</a></li>
                <li><a href="propositions.php">Propositions</a></li>
                <li><a href="deco.php">Deconnexion</a></li>';
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

