<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 05/12/16
 * Time: 20:47
 */
class Model
{
    /**
     * @var
     * variable contenant toutes les connections
     */
    public static $connection;
    /**
     * @var
     * variable contenant la connection de l'objet
     */
    protected $pdo;

    /**
     * Model constructor.
     */
    public function __construct(){
        $conf = Config::$config;
        //si la connection n'a pas déjà été crée
        if(!isset(Model::$connection[$conf['DB_NAME']]))
        {
            try {
                //essaye de créer la nouvelle connection
                $db = new  PDO('pgsql:host='.$conf['HOST'].';dbname=' . $conf['DB_NAME'] . ';user='. $conf['USER'].';password='.$conf['PASSWORD']);
                if (Config::$debug >= 1) {
                    //change le mode d'erreur, pour qu'il affiche les erreur a l'interieur de la bdd
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                }
                Model::$connection[$conf['DB_NAME']]= $db;
                $this->pdo=$db;
            } catch (PDOException $e) {
                if (Config::$debug >= 1) {
                    echo $e->getMessage();

                } else {
                    echo 'bdd indispo';
                }
            };
        }else{

            $this->pdo=Model::$connection[$conf['DB_NAME']];
        }

    }


    /**
     * @param string $mail adresse mail a verifier
     * @return bool true si l'adresse est valide, false si non
     */
    public function estValideMail($mail)
    {
        $regexp_mail="/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@]isen.yncrea.fr$/";
        if(isset($mail))
        {
            if(preg_match($regexp_mail,$mail))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $telephone numero de telelephone a verifier
     * @return bool true si il est valide, false si non
     */
    public function estValideTelephone($telephone)
    {
        $regexp_telephone="/^([+]([1-9]){1,3}|0)[1-79]([-. ]?[0-9]){8}$/";
        if(isset($telephone))
        {
            if(preg_match($regexp_telephone,$telephone))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $mot_de_passe mot_de_passe a verifier
     * @return bool true si il contient au moins  caractère, majuscule, une minuscule et un chiffre
     */
    public function estValideMotDePasse($mot_de_passe)
    {
        $regexp_mot_de_passe ="/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/";
        if(isset($mot_de_passe))
        {
            if(preg_match($regexp_mot_de_passe,$mot_de_passe))
            {
                return true;
            }
        }
        return false;
    }
}