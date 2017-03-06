<?php
session_start();
if (!isset($_SESSION['USER']) || !isset($_SESSION['IDUSER'])) {
    header('Location:../index.php');
}
require('../class/Autoloader.php');
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <script type="text/javascript" src="../js/research.js"></script>
        <script type="text/javascript" src="../js/xhr.js"></script>
        <script type="text/javascript" src="../js/posterobjet.js"></script>
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
        <?php
        $infosLoc['id_objet'] = filter_input(INPUT_POST, 'id_objet');
        $infosLoc['id_utilisateur'] = $_SESSION['IDUSER'];
        $infosLoc['date_debut'] = filter_input(INPUT_POST, 'date_debut');
        $duree = filter_input(INPUT_POST, 'duree');
        include "../fonctions/fnavbar.php";
        navbarcall(1, 3);
        Autoloader::register(1);
        if ($infosLoc['date_debut'] != NULL && $duree != NULL) {
//echo "date debut : ",$infosLoc['date_debut'],"<br> duree : ", $duree;
//creation d'un ojet datetime pour permettre l'ajout de la duree
            $date_debut = new DateTime($infosLoc['date_debut']);
// durée transformée en un objet date interval (durée en jour)
            $date_duree = new DateInterval('P' . $duree . 'D');
            $infosLoc['date_fin'] = $date_debut->add($date_duree)->format('Y-m-d');
            /* echo "id objet : ",$infosLoc['id_objet'], "<br>" ;
              echo "id utilisateur : ",$infosLoc['id_utilisateur'], "<br>" ;
              echo "date debut : ", $infosLoc['date_debut'], "<br>" ;
              echo "date fin : ",$infosLoc['date_fin'],"<br>" ; */
            $newLoc = new Location();
            $res = $newLoc->insert($infosLoc);
//echo "resultat de la requete :",$res,"<br>";
            //echo $infosLoc['id_objet'];
            $infoObjet['id_objet'] = $infosLoc['id_objet'];
            $objet = new Objet();
            $dataObjet = $objet->find($infoObjet);
            $nomObjet = $dataObjet[0]['nom_objet'];
            $idProprietaire = $dataObjet[0]['id_utilisateur'];
            
            $infoProprietaire['id_utilisateur'] = $idProprietaire;
            $proprietaire = new Utilisateur();
            $dataProprietaire = $proprietaire->find($infoProprietaire);
            $emailProprietaire = $dataProprietaire[0]['e_mail'] ;
            $nomProprietaire = $dataProprietaire[0]['nom'] ;
            $prenomProprietaire = $dataProprietaire[0]['prenom'] ;
            
            $infoLoueur['id_utilisateur'] = $infosLoc['id_utilisateur'];
            $loueur = new Utilisateur();
            $dataLoueur = $loueur->find($infoLoueur);
            $emailLoueur = $dataLoueur[0]['e_mail'];
            $nomLoueur = $dataLoueur[0]['nom'];
            $prenomLoueur = $dataLoueur[0]['prenom'];

            $dateDebut = $infosLoc['date_debut'];
            $dateFin = $infosLoc['date_fin'];

            
            ?>
            <form name="redirect" action="../pages/detailobjet.php" method="post">
                <input type="hidden" id="id_objet" name="id_objet" value="<?php echo $infosLoc['id_objet']; ?>" >
            </form>


            <div class="grey lighten-3">
                <div class="row ">
                    <span class="grey-text text-darken-4 "><br>
                        <?php
                        if ($res == 0) {
                            echo "<h5 class=\"center - align\">Votre demande a bien été transmise !</h5></br>";
                            require('../PHPMailer/PHPMailerAutoload.php');
                            $username = 'testleasen@gmail.com';
                            $password = 'mdpLeasen';

                            $mail = new PHPMailer();
                            //$mail->SMTPDebug = 1;
                            $mail->isSMTP();
                            $mail->SMTPAuth = true;
                            $mail->SMTPSecure = 'ssl';
                            $mail->Host = 'smtp.gmail.com';
                            $mail->Port = 465; // Par défaut
                            $mail->Username = $username;
                            $mail->Password = $password;
// Expéditeur
                            $mail->SetFrom('testleasen@gmail.com', 'Leasen');
// Destinataire
                            $mail->AddAddress($emailProprietaire, $nomProprietaire . ' ' . $prenomProprietaire);
// Objet
                            $mail->Subject = 'Demande Location';
                            $mail->addReplyTo($emailLoueur, $nomLoueur . ' ' . $prenomLoueur);
// Votre message
                            $mail->MsgHTML('L\'utilisateur ' . $nomLoueur . ' ' . $prenomLoueur . ' souhaite louer votre ' . $nomObjet . ' du ' . $dateDebut . ' au ' . $dateFin . '. '
                                    . 'Si vous tomber d\'accord avec le loueur, n\'oubliez pas de confirmer la location sur notre site. '
                                    . ' Cordialement  L\'équipe du site Leasen');

// Envoi du mail avec gestion des erreurs
                            if (!$mail->Send()) {
                              //  echo 'Erreur : ' . $mail->ErrorInfo;
                            } else {
                              //  echo 'Message envoyé !';
                            }
                        } elseif ($res == 4 || $res == 5) {
                            echo "<h5 class=\"center - align\">Les dates que vous avez saisient sont inccorectes. La requete n'a pas pu aboutir</h5></br>";
                        } elseif ($res == 6) {
                            echo "<h5 class=\"center - align\">L'objet est deja loué sur cette periode. Merci de bien vouloir choisir une autre date.</h5></br>";
                        } else {
                            echo "<h5 class=\"center-align\">Une erreur est survenu. Veuillez nous excusez. Merci de bien vouloir ressayer ulterieurement </h5></br> ";
                        }
                        echo "<h5 class=\"center-align\">Vous allez être redirigé dans 5 secondes</h5></br>";
                        ?>
                    </span>

                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="grey lighten-3">
                <div class="row ">
                    <h5 class="center-align grey-text text-darken-4 ">Les dates que vous avez saisi sont incorectes. La requete n'a pas pu aboutir</h5><br>
                    <h5 class="center-align grey-text text-darken-4 ">Vous allez être rediriger dans 5 secondes</h5><br>

                </div>
            </div>

            <?php
        }
        include "../fonctions/footer.php";

        // header('Refresh:5; URL=../pages/detailobjet.php');
        ?>
        <script type="text/javascript">
            setTimeout(alertFunc, 4000);
            function alertFunc() {
                document.redirect.submit();
            }

        </script>
    </body>
</html>

