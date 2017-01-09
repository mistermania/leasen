<?php
function navbaraccueil($connexion){
    
    //Si l'utilisateur n'est pas connecté
    if($connexion ==0){
      
        //barre de naviagtion + texte
        echo ' 
        <div class="grey lighten-4">
     
            <nav>
                <div class="nav-wrapper white">
                <a href="#" class="brand-logo cyan-text text-darken-4"> Leasen</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                </div>
            </nav>
            
            <div class="imagefond">
            <br>
            
            <div >
                <span class="black-text "><h4 class="center-align">Inscrivez-vous ou connectez-vous pour voir les produits</h5> </span>
            </div> 
            
             <br>';
        
        //premier formulaire pour l'inscription + bouton valider
        echo'
            <div class="row">
                <form class="col s3 offset-s2 amber darken-4">
                    <div class="row ">
                         <div class="input-field col s8 offset-s2 white">
                         <input id="first_name" type="text" class="validate">
                         <label for="first_name">Prénom</label>
                    </div>
             </div>
             
            <div class="row">
                <div class="input-field col s8 offset-s2 white">
                <input id="last_name" type="text" class="validate ">
                <label for="last_name">Nom</label>
                </div>
            </div>
      
            <div class="row ">
                <div class="input-field col s8 offset-s2 white">
                <input id="email" type="email" class="validate">
                <label for="email" data-error="wrong" data-success="right">Email</label>
                </div>
            </div>
      
            <div class="row ">
                <div class="input-field col s8 offset-s2 white ">
                <input id="password" type="password" class="validate">
                <label for="password">Mot de passe</label>
                </div>
            </div>
      
            <div class="row ">
                <div class="col s6 offset-s3 ">
                <a class="waves-effect waves-light  cyan darken-4 btn"> Inscription</a>
            </div>
            </div>
      
      
            </form>';
    
    //formulaire pour la connextion + bouton valider
    echo'
    
                <form class="col s3 offset-s2 amber darken-4 ">
      
                <div class="row ">
                    <div class="input-field col s8 offset-s2 white">
                    <input id="email" type="email" class="validate">
                    <label for="email" data-error="wrong" data-success="right">Email</label>
                    </div>
                </div>
      
                <div class="row ">
                    <div class="input-field col s8 offset-s2 white ">
                    <input id="password" type="password" class="validate">
                    <label for="password">Mot de passe</label>
                    </div>
                </div>
      
                <div class="row ">
                    <div class="col s8 offset-s3 ">
                    <a class="waves-effect waves-light  cyan darken-4 btn"> Connexion</a>
                    </div>
                </div>
      
            
          </form>
          </div>
         ';
    //fin des formulaires, dernier div pour le background
    
    //footer
        echo'
             
            <footer class="page-footer cyan darken-4">
                <div class="footer-copyright ">
                    <div class="container white-text">
                    © 2014 Copyright Text
                    <a class="right white-text" href="#!">More Links</a>
                    </div>
                </div>
          </footer>';
        
 
    } //fin de la boucle si
        }//fermeture de la fonction
        ?>
   