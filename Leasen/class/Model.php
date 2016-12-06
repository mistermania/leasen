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
}