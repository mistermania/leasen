<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 04/12/16
 * Time: 17:20
 */
/**
 * Class Autoloader
 * Autoloader à appeller dans tout les fichier utilisant des classes
 *
 * A inserer dans le code :
 * require('class/Autoloader.php')
 * Autoloader::register();
 */
class Autoloader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__,'autoload'));
    }
    static function autoload($class_name)
    {
        require 'class/'. $class_name .'.php';
    }

}
?>