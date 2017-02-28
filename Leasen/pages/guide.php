<?php
session_start();
?>
<html>
<head>
    <meta charset="UTF-8">
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <!-- <link href="css/navbar.css" rel="stylesheet" type="text/css"/> -->
    <link href="../css/paccueil.css" rel="stylesheet" type="text/css"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="../css/footerb.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>

<?php
include "../fonctions/fnavbar.php";
navbarcall(1, 0);

require('../class/Autoloader.php');
Autoloader::register(1);
?>
 <div class="grey lighten-3">
<article class="col s8 offset-s2 white">
   <div class="grey lighten-3">

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
                    Vous êtes contactés par mail si un étudiant est intéressé par votre annonce. Avant la location,
                    remplisser
                    le contrat de location qui vous est proposé plus bas et récupérer votre paiement. <br><br>
                </p>
                <p class="center-align grey-text text-darken-4"> Si vous souhaitez louer un objet : <br>
                    Inscrivez-vous avec votre adresse mail de l'ISEN. Puis rechercher parmi les annonces un bien à
                    louer. Vous
                    avez la possibilité de faire une annonce indiquant le bien dont vous avez besoin si il n'est pas
                    proposé sur le site.
                    Pour récupérer l'objet voulu, faite une demande de location, remplisser le contrat de location qui
                    vous est proposé plus bas et payer le propriétaire. <br> <br>
                    Après la location, vous pouvez noter l'objet pour aider les autres loueurs.
                </p>
                <p class="center-align grey-text text-darken-4"> Ainsi, les propriétaires gagnent de l'argent en les
                    mettant à louer ou apportent de la convivialité par le prêt de biens. <br>
                    Les locataires économisent de l'argent. <br> <br>
                </p>
                <h4 class="center-align deep-orange-text"><b> Leasen ? C'est simple, rapide et chaleureux !</b></h4>
                <br>
                <h4 class="center-align deep-orange-text"> Le contrat de location </h4>
                <p class="center-align grey-text text-darken-4"> Le site Leasen n’est en aucun cas partie prenante du
                    présent contrat et ne pourra être tenu comme responsable,
                    direct ou indirect, d’éventuels litiges ou dommages relatifs à l’exécution du contrat. Si, en cas de
                    litige,
                    le locataire et le propriétaire ne trouvent pas de solution à l’amiable,
                    alors les tribunaux du lieu de signature du présent contrat seront retenus pour seuls compétents.
                    <br/>
                </p>
                <p class="center-align grey-text text-darken-4"> Avant la location / prêt, nous vous conseillons de
                    remplir un contrat de location et de le garder le temps de la location ou du prêt.
                    Vous pouvez téléchargé le contrat que nous vous proposons ci-dessous. Il est a remplir par le
                    propriétaire et le locataire lors de la rencontre. <br><br/>
                    <a class="waves-effect waves-light deep-orange white-text btn"
                       href="../res/Contrat de location.pdf">
                        Télécharger un exemplaire</a> <br/><br/>
                    Vous êtes libre de rédiger votre propre contrat ci celui-ci ne vous convient pas.
                </p>
                <br>
            </div>
        </section>
        <br>
        </div>
</article>
<?php
include "../fonctions/footer.php";
?>
</div>
</body>
</html>