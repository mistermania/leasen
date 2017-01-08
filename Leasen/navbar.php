<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
         <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link href="css/navbar.css" rel="stylesheet" type="text/css"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
    
    </head>
    <body>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script src="js/principale.js" type="text/javascript"></script> 
        
        
         
        
        <nav>
            <div class="nav-wrapper blue darken-2">
              <a href="#" class="brand-logo">Leasen</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="listeobjets.php">Les objets</a></li>
                <li><a href="listedemandes.php">Les demandes</a></li>
                <li><a href="propositionobjet.php"> Proposer un objet</a></li>
                <li><a href="fairedemande.php">Faire une demande</a></li>
                <li><a href="guide.php">Guide</a></li>
                <li><a class="dropdown-button" href='#' data-activates="dropdown1">Mon compte<i class="material-icons right">arrow_drop_down</i></a></li>
                
              </ul>
              
            </div>
        </nav>
        
              
              <ul id="dropdown1" class="dropdown-content">
        <li><a href="#!">Modifier mes informations</a></li>
        <li class="divider"></li>
        <li><a href="#!">Déconnexion</a></li>
        
        </ul>
              
        
        
    </body>
</html>
