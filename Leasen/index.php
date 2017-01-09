
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require('class/Autoloader.php');
    Autoloader::register();
    session_start();
?>
<html>
    <head>
         <meta charset="UTF-8">
        <title></title>
        
         <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link href="css/navbar.css" rel="stylesheet" type="text/css"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        
    </head>
    <body>
        
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script src="js/principale.js" type="text/javascript"></script> 
        
        
        <?php
             include "fonctions/fnavbar.php";
             include"fonctions/faffichageprincipale.php";
        isset($_SESSION['USER'])?navbarcall(1,1):navbarcall(0   ,1);
        affichageprincipale(1);

        ?>
    </body>
</html>
