<html>
<head>

</head>
<body>
<?php
require('class/Autoloader.php');
Autoloader::register(0);
$calendar = new Calendar();
echo $calendar->afficheCalendrierObjet(7);
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

require('PHPMailer/class.phpmailer.php');

$mail = new PHPMailer();
$mail->Host = 'localhost';
$mail->SMTPAuth   = false;
$mail->Port = 25; // Par défaut

// Expéditeur
$mail->SetFrom('thomas.artru@isen.yncrea.fr', 'ARTRU Thomas');
// Destinataire
$mail->AddAddress('artru.thomas.monchal@gmail.com', 'Thomas ARTRU');
// Objet
$mail->Subject = 'Test de php mailer';

// Votre message
$mail->MsgHTML('essai de php mailler');

// Envoi du mail avec gestion des erreurs
if(!$mail->Send()) {
    echo 'Erreur : ' . $mail->ErrorInfo;
} else {
    echo 'Message envoyé !';
}

?>