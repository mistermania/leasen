<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 23/02/17
 * Time: 13:41
 */
/*Exemple de  messages au format texte et au format HTML.
    $contenu_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
    $contenu_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
*/
/**
 * @param String $mail adresse mail du destinataire
 * @param String $sujet sujet du mail
 * @param String $contenu contenu du mail
 * @param String $mailContact adresse mail a laquelle l'utilisateur doit repondre
 */
function sendMail($mail, $sujet ,$contenu, $mailContact)
{
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
    {
        $passage_ligne = "\r\n";
    } else {
        $passage_ligne = "\n";
    }

//=====Création de la boundary
    $boundary = "-----=" . md5(rand());
//==========

//=====Création du header de l'e-mail.
    $header = "From: \"Leasen\"<contact@leasen.fr>" . $passage_ligne;
    $header .= "Reply-to: \"Contact\"".$mailContact. $passage_ligne;
    $header .= "MIME-Version: 1.0" . $passage_ligne;
    $header .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
//==========

//=====Création du message.
    $message = $passage_ligne . "--" . $boundary . $passage_ligne;
//=====Ajout du message au format texte.
    $message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"" . $passage_ligne;
    $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
    $message .= $passage_ligne . $contenu . $passage_ligne;
//==========
    $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
    $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
//==========

//=====Envoi de l'e-mail.
    mail($mail, $sujet, $message, $header);
//==========
}