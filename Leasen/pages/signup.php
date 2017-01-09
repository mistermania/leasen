<?php

    require('../class/Autoloader.php');
    Autoloader::register();
?>


<?php

    $newuser = new Utilisateur();
   
    $nom =  filter_input(INPUT_POST, 'nom');
    $prenom =  filter_input(INPUT_POST, 'prenom');
    $e_mail =   filter_input(INPUT_POST, 'user_email');
    $mot_de_passe = filter_input(INPUT_POST, 'pass');
    $telephone = filter_input(INPUT_POST, 'numerotel');
    $partager_telephone = filter_input(INPUT_POST, 'telchoix');
    
    echo "$nom   /  $prenom    / $e_mail /  $mot_de_passe  /  $telephone  / $partager_telephone <br/>" ;
    
    $userInfos=array('nom'=> $nom, 'prenom'=>$nom, 'e_mail'=>$e_mail, 'mot_de_passe'=>$mot_de_passe, 'telephone'=>$telephone, 'partager_telephone'=>(int)$partager_telephone);
    $test= $newuser->insert($userInfos);
    
     
    /*$tchou=new Utilisateur();
        $updateUser=array('nom'=>'tchoutchou' , 'prenom' => 'guillaume' ,'e_mail' => 'guillaumte.feltrin@isen.yncrea.fr', 'mot_de_passe' => 'rootA8fefef','telephone'=> '+33484070306', 'partager_telephone'=> 0);
        $tchou->insert($updateUser);
      */  

    /**
     * @param $info array contenant : nom, prenom, email, partager_telephone, telephone,statut, mot de passe
     * @return int 1 : nom, prenom et email absent
     * @return int 2 :le numero de telephone n'est pas un numero de telpehone valide
     * @return int 3 : adresse mail invalide
     * @return int 4 : mot de passe trop faible (moins de 8 caractère, absence d'une chiffre, d'une majuscule et d'une minuscule
     * @return int 5 : adresse déja presente dans la base de donnée
     * @return int 6 : numero deja present dans la base de donnée
     * @return int 0 : insertion reussie
     */
    
    if($test == 1) {
        echo "nom, prenom ou email absent";
    }
    if($test==2){
        echo "numero de téléphone non valide";
    }
    if($test==3){
        echo "adresse mail invalide";
    }
    if($test==4){
        echo "mot de passe trop faible (moins de 8 caractère, pas de chiffre ou/et pas de majuscules";
    }
    if($test==5){
        echo "Adresse déjà utilisée";
    }
    if($test==6){
      echo "numero de telephone déjà utilisé";
    }
    if($test==0){
        echo "<br/> inscription réussie";
    }
