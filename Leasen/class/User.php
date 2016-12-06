<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 06/12/16
 * Time: 09:30
 */
class User extends Model
{
    /**
     * @param $info tableau contenant : nom, prenom, email, partager_telephone, telephone,statut, mot de passe
     */
    public function createUser($info)
    {
        $hash=password_hash($info['mot_de_passe'],PASSWORD_DEFAULT);
        $sql='INSERT INTO utilisateur (id_utilisateur,nom,prenom,date_creation_compte,e_mail,partager_telephone,telephone,hash_mot_de_passe,statut) VALUES (';
        $sql.='(SELECT max(id_utilisateur)+1 FROM utilisateur)';
        $sql.=',\''.$info['nom'].'\'';
        $sql.=',\''.$info['prenom'].'\'';
        $sql.=',\''.date('Y-m-d').'\'';
        $sql.=','.(isset($info['email'])?'\''.$info['email'].'\'':'NULL');
        $sql.=','.(isset($info['partager_telephone'])?$info['partager_telephone']:'NULL');
        $sql.=','.(isset($info['telephone'])?$info['telephone']:'NULL');
        $sql.=',\''.$hash.'\'';
        $sql.=','.(isset($info['statut'])?$info['statut']:'0');
        $sql.=');';
        echo $sql;
        $req=$this->pdo->prepare($sql);
        try{
            $req->execute();
        }catch (PDOException $e)
        {
            if (Config::$debug >= 1) {
                echo $e->getMessage();

            } else {
                echo 'bdd indispo';
            }
        }
    }

}