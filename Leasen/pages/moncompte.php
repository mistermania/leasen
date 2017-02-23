<?php //
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
$annonce = new Objet();
$infoUser['o_est_affiche'] = true;
$res = $annonce->find($infoUser);
?>

<div class="grey lighten-3">
    <div class="row ">
        <br/><h5 class="center-align"> Mes annonces </h5> <br>

        <table class="centered bordered responsive-table white grey-text text-darken-4">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Caution</th>
                <th>Prix</th>
                <th> Modifier l'annonce</th>
                <th> Supprimer</th>

            </tr>
            </thead>

            <tbody>


            <?php


            foreach ($res as $k => $v) {
                if ($v['o_est_affiche'] == true) {

                    ?>

                    <tr>
                        <td> <?php echo $v["nom_objet"]; ?> </td>
                        <td> <?php echo $v["description_objet"]; ?> </td>
                        <td> <?php echo $v["prix_caution"]; ?> </td>
                        <td> <?php echo $v["prix"]; ?> </td>
                        <td>

                            <form method="post" action="editerobjet.php">
                                <input type="hidden" id="id_objet" name="id_objet"
                                       value="<?php echo $v["id_objet"]; ?>"/>
                                <input type="submit" value="Modifier" class="btn deep-orange darken-1 white-text">


                            </form>
                        </td>
                        <td>

                            <form method="post" action="supprimerobjet.php">
                                <input type="hidden" id="id_objet" name="id_objet"
                                       value="<?php echo $v["id_objet"]; ?>"/>
                                <input type="submit" value="Supprimer" class="btn deep-orange darken-1 white-text">


                            </form>
                        </td>

                    </tr>


                    <?php
                }
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
