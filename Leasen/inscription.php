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
        <div id="content">
                <h1>Inscription</h1>
                <p>Merci de renseigner les différents champs afin de vous inscrire</p>
                <form method="post" action="./signup.php">
                    <label>nom :</label><input type="text" name="nom" required/><br/>
                    <label>prenom :</label><input type="text" name="prenom" required/><br/>
                    <label>Mot de passe :</label><input type="password" name="pass" required/><br/>
                    <label>Email:</label><input type="email" name="user_email"><br/>
                    <label>Numero de telephone:</label><input type="tel" name="numerotel"><br/>
                    <?php //$updateUser=array('nom'=>'tchoutchou' , 'prenom' => 'guillaume' ,'e_mail' => 'guillaumte.feltrin@isen.yncrea.fr', 'mot_de_passe' => 'rootA8fefef','telephone'=> '+33484070306', 'partager_telephone'=> 0);
                    ?>
                    <label>partager telephone:</label>
                    <label>Oui
                    <input type="radio" name="telchoix" value="1">
                    </label>
                    <label>Non
                    <input type="radio" name="telchoix" value="0">
                    </label><br/>
                    
                    <input type="submit" value="M'inscrire"/>
                </form>
        </div>
        
    </body>
</html>
