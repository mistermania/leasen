
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require('class/Autoloader.php');
    Autoloader::register();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
         <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
    </head>
    <body>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        
        <?php
             include "fnavbar.php";
             navbarcall(1,1);
        ?>
        <?php
            /*$test = new Utilisateur();
            $info=array('nom'=>'tchou' , 'prenom' => 'guillaume' ,'e_mail' => 'guillaum.feltrin@isen.yncrea.fr', 'mot_de_passe' => 'rootA8fefef','telephone'=> '+33484050306', 'partager_telephone'=> 0);
            $id=6;
            print_r($test->updateInfo($info,$id));*/



        $date=new DateTime();
        $h= $date->getTimestamp();
        $loc= new Location();
        $infoLoc=array('id_utilisateur'=>5,'id_objet'=>2,'date_debut'=>'2016-12-10 22:54:36', 'date_fin'=> '2016-12-19 22:54:36');
        print_r($loc->createLocation($infoLoc));
        ?>

    </body>
</html>
