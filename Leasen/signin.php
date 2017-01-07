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
    </head>
    <body>
        <?php

            require('class/Autoloader.php');
            Autoloader::register();
        ?>
        <?php
            $newuser = new Utilisateur();
            $e_mail =   filter_input(INPUT_POST, 'user_email');
            $mot_de_passe = filter_input(INPUT_POST, 'pass');
            
            
            $test= $newuser->find("e_mail = '$e_mail'");
           echo '<pre>';
           if(!empty($test))
           {
            $hash=$test[0]['hash_mot_de_passe'];
            if(!empty($test)) 
            {
                if(password_verify($mot_de_passe, $hash))
                {
                    echo ' c\'est bon jamy';
                }else
                {
                    echo 'fail';
                }
            }
           }
            echo '</pre>';
        ?>
    </body>
</html>
