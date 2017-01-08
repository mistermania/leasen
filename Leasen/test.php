<?php
/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 08/12/16
 * Time: 21:54
 */
require('class/Autoloader.php');
Autoloader::register();
echo $_POST;
//location
/*$loc= new Location();
$infoLoc=array('id_utilisateur'=>2,'id_objet'=>3,'date_debut'=>'2016-12-10 22:54:36', 'date_fin'=> '2016-12-19 22:54:36');
$id=3;
$retour=$loc->update($infoLoc,$id);
*/
//user
/*
$tchou=new Utilisateur();
$updateUser=array('nom'=>'tchoutchou' , 'prenom' => 'guillaume' ,'e_mail' => 'guillaumte.feltrin@isen.yncrea.fr', 'mot_de_passe' => 'rootA8fefef','telephone'=> '+33484070306', 'partager_telephone'=> 0);
$retour=$tchou->insert($updateUser);
*/
/*
$r=new Utilisateur;
$retour=$r->find("id_utilisateur<5");
*/

$raclette= new Objet();
$infoObjet=array('id_type'=>2, 'nom_objet'=>'bob');
$retour=$raclette->update($infoObjet,3);
if(is_array($retour))
{
    print_r($retour);
}else{
    echo $retour;
}
?>
