
<?php
require('class/Autoloader.php');
Autoloader::register(0);
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="css/piedpage.css" rel="stylesheet" type="text/css"/>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
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
include "fonctions/faffichageprincipale.php";
isset($_SESSION['USER']) ? navbarcall(1, 1) : navbarcall(0, 1);

isset($_SESSION['USER']) ? affichageprincipale(1) : affichageprincipale(0);   
include "fonctions/footer.php";

?>

</body>
</html>