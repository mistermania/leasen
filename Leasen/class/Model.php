<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 05/12/16
 * Time: 20:47
 */
class Model
{
    public static $connection;
    protected $pdo;

    public function __construct(){
        $conf = Config::$config;
        if(!isset(Model::$connection[$conf['DB_NAME']]))
        {
            try {
                $db = new  PDO('pgsql:host='.$conf['HOST'].';dbname=' . $conf['DB_NAME'] . ';user='. $conf['USER'].';password='.$conf['PASSWORD']);
                if (Config::$debug >= 1) {
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