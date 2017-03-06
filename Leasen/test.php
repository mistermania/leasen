<html>
    <head>

    </head>
    <body>
        <?php
//require('class/Autoloader.php');
//Autoloader::register(0);
//$calendar = new Calendar();
//echo $calendar->afficheCalendrierObjet(7);
        ?>
    <html><body><br /><p align=center>
                <br />
            <form name="formulaire" method="POST"  action="test.php"  enctype="multipart/form-data" >
                <input id="fichier1"  name="fichier" type="file"  />
                <input value="Valider" name="submit" type="submit" />
            </form><br />
        </p>
    </body></html>
<?php
require('PHPMailer/PHPMailerAutoload.php');
$username = 'testleasen@gmail.com';
$password = 'mdpLeasen';
do {
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
    $mail->SetFrom('testleasen@gmail.com', 'COUCOU C NOUS');
// Destinataire
    $mail->AddAddress('yanis1.meziane@gmail.com', 'c toi');
// Objet
    $mail->Subject = 'coucou';

// Votre message
    $mail->MsgHTML('coucou c nous');

// Envoi du mail avec gestion des erreurs
    if (!$mail->Send()) {
        echo 'Erreur : ' . $mail->ErrorInfo;
    } else {
        echo 'Message numero !' . $i . '</br>';
        $i++;
    }
}while(1==1);
?>