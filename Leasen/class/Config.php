<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 05/12/16
 * Time: 20:42
 */
class Config
{
    /**
     * @var int 1 pour afficher les informations de debug,0 sinon
     */
    static $debug =1;
    /**
     * @var array contient les informatons concernant la BDD
     */
    public static $config = array( "HOST" => 'db_postgres',
                                "USER" => "leasen",
                                "PASSWORD" => "root",
                                "DB_NAME" => "db_leasen");

}