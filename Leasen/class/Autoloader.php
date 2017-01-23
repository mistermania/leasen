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
 *
 * require('class/Autoloader.php');
 * Autoloader::register($var);, avec $ la hauteur du fichier par rapport a la racine ( /index est a la hauteur 0, les fichiersdans /pages sont à hauteur 1
 *
 */
class Autoloader
{
    /**
     * @param int $hauteur nom de dossier par rapport a l'index
     */
    static function register($hauteur)
    {
        if($hauteur==0) {
            spl_autoload_register(array(__CLASS__, 'autoload'));
        }elseif ($hauteur==1)
        {
            spl_autoload_register(array(__CLASS__, 'autoload1'));
        }else{
            spl_autoload_register(array(__CLASS__, 'autoload1'));
        }
        }

    /**
     * @param string $class_name nom de la class
     * fonction utilisée par les fichier situé à la racine
     */
    static function autoload($class_name)
    {
        require 'class/'. $class_name .'.php';
    }

    /**
     * @param string $class_name nom de la class
     * fonction utilisée par les fichier situé au dessus de la racine
     */
    static function autoload1($class_name)
    {
        require '../class/'. $class_name .'.php';
    }


}
