<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 06/12/16
 * Time: 09:30
 */
class User extends Model
{
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
    public function createUser($info)
    {

        if(!isset($info['nom']) or !isset($info['prenom']) or !isset($info['e_mail']) or !isset($info['mot_de_passe']))
        {
            //si les informations minimales ne sont pas remplies.
            return 1;
        }
        if(isset($info['telephone'])) {
            if(!$this->estValideTelephone($info['telephone'])){
               echo 'numero de merde';
                return 2;
            }
            $cond_tel=array('telephone'=> $info['telephone']);
            if(!empty($this->find($cond_tel))){
                return 6;
            }

        }
        //si l'adresse email ne correspond pas au paterne attendu
        if(!$this->estValideMail($info['e_mail']))
        {
            return 3;
        }

        //si le mot de passe contient moins de 8 caractère, dont une minuscule, une majuscule et un chiffre
        if (!$this->estValideMotDePasse($info["mot_de_passe"])) {
            return 4;
        }
        $cond=array('e_mail'=> $info['e_mail']);
        $mail=$this->find($cond);
        //si l'email est present dans la base de donnée
        if(!empty($mail)) {
            return 5;
        }
        if(isset($info['partager_telephone']))
        {
            if($info['partager_telephone'])
            {
                $info['partager_telephone']='TRUE';
            }
            else
            {
                $info['partager_telephone']='FALSE';
            }
        }else{
            $info['partager_telephone']='FALSE';
        }
        return $this->insertUserBdd($info);
    }

    /**
     * @param array $info
     * @return int 0: tout c'est bien passés
     *
     * ajoute un utilisateur a la base de donnée
     */
    private function insertUserBdd($info)
    {
        //chiffrement du mot de passe
        $hash=password_hash($info['mot_de_passe'],PASSWORD_DEFAULT);
        $sql='INSERT INTO utilisateur (id_utilisateur,nom,prenom,date_creation_compte,e_mail,partager_telephone,telephone,hash_mot_de_passe,statut) VALUES ( ';
        $sql.='(SELECT max(id_utilisateur)+1 FROM utilisateur)';
        $sql.=',\''.strtolower($info['nom']).'\'';
        $sql.=',\''.strtolower($info['prenom']).'\'';
        $sql.=',\''.date('Y-m-d').'\'';
        $sql.=',\''.$info['e_mail'].'\'';
        $sql.=','.$info['partager_telephone'];
        $sql.=','.(isset($info['telephone'])?'\''.$info['telephone'].'\'':'NULL');
        $sql.=',\''.$hash.'\'';
        //le statut d'admin ne peut etres obtenu qu'après la creation du compte
        $sql.=',0';
        $sql.=');';
        echo $sql;
        $req=$this->pdo->prepare($sql);
        try{
            $req->execute();
        }catch (PDOException $e)
        {
            if (Config::$debug >= 1) {
                echo $e->getMessage();

            } else {
                echo 'bdd indispo';
            }

        }
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param mixed $cond
     * si $cond est un tableau, ajout a la requete de condtion where clé=valeur pour chaque couple clé valeur
     * sinon ajout de la conditon après le where
     * @return mixed: tableau contenant les information des utilisateurs repondant aux condition
     */
    public function find($cond){
        $sql='SELECT * FROM utilisateur';
        $a_cond=array();
        if(isset($cond)) {
            $sql.=' WHERE ';
            if (is_array($cond)) {
                foreach ($cond as $k => $v) {
                    //if (!is_numeric($v)) {
                    $v = '\'' . $v . '\'';
                    //}
                    $a_cond[]="$k = $v";
                }
                $sql.=implode(' AND ',$a_cond);

            } else {
                $sql .= $cond;
            }
        }
        $req=$this->pdo->prepare($sql);
        try{
            $req->execute();
        }catch (PDOException $e)
        {
            if (Config::$debug >= 1) {
                echo $e->getMessage();
            } else {
                echo 'bdd indispo';
            }
        }
        return $req->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     * @param $info
     * @param $id : id de l'utilisateur
     * @return int 1 : info contient des champs absent de la bdd
     * @return int 2 :le numero de telephone n'est pas un numero de telpehone valide
     * @return int 3 : adresse mail invalide
     * @return int 4 : mot de passe trop faible (moins de 8 caractère, absence d'une chiffre, d'une majuscule et d'une minuscule
     * @return int 5 : adresse déja presente dans la base de donnée
     * @return int 6 : numero deja present dans la base de donnée
     * @return int 0 : insertion reussie
     */
    public function updateInfo($info, $id)
    {
        $champ=array('nom','prenom','e_mail','partager_telephone','telephone','mot_de_passe','est_ban','raison_ban');
        foreach ($info as $k => $v)
        {
            if(!in_array($k,$champ))
            {
                return 1;
            }
        }
        if(isset($info['mot_de_passe']))
        {
            if(!$this->estValideMotDePasse($info['mot_de_passe']))
            {
                return 4;
            }
            $info['hash_mot_de_passe']=password_hash($info['mot_de_passe'],PASSWORD_DEFAULT);
            unset($info['mot_de_passe']);
        }
        if(isset($info['e_mail']))
        {
            if(!$this->estValideMail($info['e_mail']))
            {
                return 3;
            }
            $cond=' e_mail= \''.$info['e_mail'].'\' AND id_utilisateur !='.$id.';';
            $mail=$this->find($cond);
            //si l'email est present dans la base de donnée
            if(!empty($mail)) {
                return 5;
            }

        }
        if(isset($info['telephone'])) {
            if(!$this->estValideTelephone($info['telephone'])){
                return 2;
            }
            $cond_tel=' telephone=\''.$info['telephone'].'\' AND id_utilisateur !='.$id.';';
            if(!empty($this->find($cond_tel))){
                return 6;
            }

        }
        if(isset($info['partager_telephone']))
        {
            if($info['partager_telephone'])
            {
                $info['partager_telephone']='TRUE';
            }
            else
            {
                $info['partager_telephone']='FALSE';
            }
        }
        if(isset($info['est_ban']))
        {
            if($info['est_ban'])
            {
                $info['est_ban']='TRUE';
            }
            else
            {
                $info['est_ban']='FALSE';
            }
        }

        return $this->updateInfoBdd($info,$id);
    }

    /**
     * @param $info
     * @param $id
     * @return mixed
     */
    private function updateInfoBdd($info, $id)
    {
        $sql='UPDATE utilisateur SET ';
        if(is_array($info) and is_int($id)) {
            foreach ($info as $k => $v) {
                /*if (is_string($v)) {
                    $v = "'$v'";
                }*/
                $sql .= $k . ' = \'' . $v . '\',';
            }
            //on enleve la dernière virgule
            $sql=substr($sql, 0, -1);
            $sql.=' WHERE id_utilisateur = '.$id;
            echo $sql;
            $req=$this->pdo->prepare($sql);
            try{
                $req->execute();
            }catch (PDOException $e)
            {
                if (Config::$debug >= 1) {
                    echo $e->getMessage();
                } else {
                    echo 'bdd indispo';
                }
            }
            return $req->fetchAll(PDO::FETCH_OBJ);
        }
    }
}