<?php
session_start();
if (!isset($_SESSION['USER']) || !isset($_SESSION['IDUSER'])) {
    header('Location:index.php');
}
?>
<html>
<head>
    <meta charset="utf-8"/>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>


<?php
include "../fonctions/fnavbar.php";
navbarcall(1, 5);

require('../class/Autoloader.php');
Autoloader::register(1);

$infoUser['id_utilisateur'] = $_SESSION['IDUSER'];
$annonce = new recherche_message();
$res = $annonce->effectueRecherche($infoUser);
?>

<div class="grey lighten-3">
    <div class="row ">
        <br/><h5 class="center-align"> Vous avez reçu des demandes, avez vous prêté ces objets : </h5> <br>

        <table class="centered bordered responsive-table white grey-text text-darken-4">
            <thead>
            <tr>
                <th>Nom de l'objet</th>
                <th>Date du début de la location</th>
                <th>Date de fin de la location</th>
                <th>Nom du loueur</th>
                <th>Confirmation</th>

            </tr>
            </thead>

            <tbody>

            <?php
            foreach ($res as $k => $v) {
                ?>

                <tr>
                    <td> <?php echo $v["nom_objet"]; ?> </td>
                    <td> <?php echo $v["date_debut"]; ?> </td>
                    <td> <?php echo $v["date_fin"]; ?> </td>
                    <td> <?php echo $v["nom"]; ?> </td>
                    <td>
                        <form method="post" action="confirmer_location.php">
                            <input type="hidden" id="id_objet" name="id_objet" value="<?php echo $v["id_objet"]; ?>"/>
                            <input type="submit" class=" col s3 offset-s3 deep-orange btn" value="Oui">
                        </form>
                        <form method="post" action="refuser_location.php">
                            <input type="hidden" id="id_objet" name="id_objet" value="<?php echo $v["id_objet"]; ?>"/>
                            <input type="submit" class=" col s3 offset-s1 deep-orange btn" value="Non">
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <br>
    <footer class="page-footer cyan darken-1">

        <div class="footer-copyright">
            <div class="container">
                © 2017 LEASEN Tous droits réservés.

            </div>
        </div>
    </footer>
</div>

</body>

</html>

