<?php
session_start();
require('../class/Autoloader.php');
Autoloader::register(1);
?>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../css/piedpage.css" rel="stylesheet" type="text/css"/>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <!-- <link href="css/navbar.css" rel="stylesheet" type="text/css"/> -->
    <link href="../css/paccueil.css" rel="stylesheet" type="text/css"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
</head>
<body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script src="../js/principale.js" type="text/javascript"></script>


<?php

include "../fonctions/fnavbar.php";
navbarcall(1, 0);



?>
 

<article class="col s8 offset-s2 ">
   
    
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
                </p>
                
                <br>
                <h4 class="center-align deep-orange-text"> Comment ça marche ?</h4>
                <p class="center-align grey-text text-darken-4"> Si vous souhaitez mettre en location ou prêter des
                    objets :<br>
                    Inscrivez-vous avec votre adresse mail de l'ISEN. Puis déposer vos annonces dans la page poster un
                    objet.
                    Vous êtes contacté par mail si un étudiant est intéressé par votre annonce. Avant la location,
                    remplissez
                    le contrat de location qui vous est proposé plus bas et récupérez votre paiement. <br><br>
                </p>
                <p class="center-align grey-text text-darken-4"> Si vous souhaitez louer un objet : <br>
                    Inscrivez-vous avec votre adresse mail de l'ISEN. Puis rechercher parmi les annonces un bien à
                    louer. Vous
                    avez la possibilité de faire une annonce indiquant le bien dont vous avez besoin s'il n'est pas
                    proposé sur le site.
                    Pour récupérer l'objet voulu, faites une demande de location, remplissez le contrat de location qui
                    vous est proposé plus bas et payez le propriétaire. <br> <br>
                    Après la location, vous pouvez noter l'objet pour aider les autres loueurs.
                </p>
                <p class="center-align grey-text text-darken-4"> Ainsi, les propriétaires gagnent de l'argent en les
                    proposant à la location ou apportent de la convivialité par le prêt de biens. <br>
                    Les locataires économisent de l'argent. <br> <br>
                </p>
                <h4 class="center-align deep-orange-text"><b> Leasen ? C'est simple, rapide et chaleureux !</b></h4>
                <br>
                <h4 class="center-align deep-orange-text"> Le contrat de location </h4>
                <p class="center-align grey-text text-darken-4"> Le site Leasen n’est en aucun cas partie prenante du
                    présent contrat et ne pourra être tenu comme responsable,
                    directement ou indirectement, d’éventuels litiges ou dommages relatifs à l’exécution du contrat. Si, en cas de
                    litige,
                    le locataire et le propriétaire ne trouvent pas de solution à l’amiable,
                    alors les tribunaux du lieu de signature du présent contrat seront retenus pour seuls compétents.
                    <br/>
                </p>
                <p class="center-align grey-text text-darken-4"> Avant la location / prêt, nous vous conseillons de
                    remplir un contrat de location et de le garder le temps de la location ou du prêt.
                    Vous pouvez télécharger le contrat que nous vous proposons ci-dessous. Il est à remplir par le
                    propriétaire et le locataire lors de la rencontre. <br><br/>
                    <a class="waves-effect waves-light deep-orange white-text btn"
                       href="../res/Contrat de location.pdf">
                        Télécharger un exemplaire</a> <br/><br/>
                    Vous êtes libre de rédiger votre propre contrat si celui-ci ne vous convient pas. <br/><br/>
                </p>
                <br/>
            </div>
        </section>
    
         
        
</article>
 


<footer class="footer"><p>&copy;2017 LEASEN Tous droits réservés.<p> </footer>

</body>
</html>