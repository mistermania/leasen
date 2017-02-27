<?php
/*require('class/Autoloader.php');
Autoloader::register(0);
$retour = Model::idAbsent(2, 'Utilisateur');
$lunette = new Objet();
$lunette->delete(18);
echo "<pre>";
print_r($lunette->find("id_objet>1","",5));
echo "</pre>";
echo $retour;
*/
include "fonctions/sendMail.php";
$mail = "artru.thomas.monchal@gmail.com";
$sujet = "test";
$content = "afafazfazfazfazfazfazfazfazfazf";
$mailRetour = "william.billaud@isen.yncrea.fr";
sendMail($mail,$sujet,$content,$mailRetour);

function mail_utf8($to, $from_user, $from_email,
                   $subject = '(No subject)', $message = '')
{
    $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
    $subject = "=?UTF-8?B?".base64_encode($subject)."?=";

    $headers = "From: $from_user <$from_email>\r\n".
        "MIME-Version: 1.0" . "\r\n" .
        "Content-type: text/html; charset=UTF-8" . "\r\n";

    return mail($to, $subject, $message, $headers);
}
$res = mail_utf8("artru.thomas.monchal@gmail.com","thomas","test@leasen.fr","test","blzalbzvlvbzebz");
echo "coucou : ";
echo $res;