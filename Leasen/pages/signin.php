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
    </head>
    <body>
        <?php
        session_start();
        require('../class/Autoloader.php');
        Autoloader::register(1);
        $newuser = new Utilisateur();
        $e_mail = filter_input(INPUT_POST, 'user_email');
        $mot_de_passe = filter_input(INPUT_POST, 'pass');
        $test = $newuser->find(array('e_mail' => $e_mail));
        if (!empty($test)) {
            $hash = $test[0]['hash_mot_de_passe'];
            if (!empty($test)) {
                if (password_verify($mot_de_passe, $hash)) {
                    echo 'Bonjour ' . $test[0]['nom'] . '';
                    $_SESSION['USER'] = $e_mail;
                    $_SESSION['IDUSER'] = $test[0]['id_utilisateur'];
                    header('Location:../index.php');
                    exit();
                } else {
                    echo 'Mauvaise combinaison, merci de réessayer.';
                    $retour=1;
                }
            }
        } else {
            echo 'Mauvaise combinaison, merci de réessayer.';
            $retour=1;
        }
        ?>
        <form name="redirect" action="../pages/connexion.php" method="post">
            <input type="hidden" id="resu" name="resu" value="<?php echo $retour; ?>" >
        </form>
        <script type="text/javascript">
            document.redirect.submit();
        </script>
        <?php
        include "../fonctions/footer.php";
        ?>
    </body>
</html>