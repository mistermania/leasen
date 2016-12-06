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
     * @return
     */
    public function createUser($info)
    {
        $regexp_mail="/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@]isen.yncrea.fr$/";
        $regexp_telephone="/^([+]([1-9]){1,3}|0)[1-79]([-. ]?[0-9]){8}$/";
        if(!isset($info['nom']) or !isset($info['prenom']) or !isset($info['email']) )
        {
            //si les informations minimales ne sont pas remplies.
            return 1;
        }
        if(isset($info['telephone'])) {

            if (!preg_match($regexp_telephone,$info['telephone'])) {
                //si le numero de telephone n'est pas un nombre
                echo 'fail numero telephone';
                return 2;

            }
        }
        if(preg_match($regexp_mail,$info['email']))
        {
            echo 'ca match <br>';
        }
        else{
            echo 'Fail';
            return 3;
        }
        /*if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $info["mot_de_passe"])) {
            echo "Your passwords is strong.";
        } else {
            echo "Your password is weak.";
            return 4;
        }*/
        $cond=array('e_mail'=> $info['email']);
        $mail=$this->find($cond);
        if(empty($mail)) {
            return $this->insertUser($info);

        }else{
            return 5;
        }
    }

    private function insertUser($info)
    {
        $hash=password_hash($info['mot_de_passe'],PASSWORD_DEFAULT);
        $sql='INSERT INTO utilisateur (id_utilisateur,nom,prenom,date_creation_compte,e_mail,partager_telephone,telephone,hash_mot_de_passe,statut) VALUES (';
        $sql.='(SELECT max(id_utilisateur)+1 FROM utilisateur)';
        $sql.=',\''.strtolower($info['nom']).'\'';
        $sql.=',\''.strtolower($info['prenom']).'\'';
        $sql.=',\''.date('Y-m-d').'\'';
        $sql.=',\''.$info['email'].'\'';
        $sql.=','.(isset($info['partager_telephone'])?$info['partager_telephone']:'NULL');
        $sql.=','.(isset($info['telephone'])?$info['telephone']:'NULL');
        $sql.=',\''.$hash.'\'';
        $sql.=','.(isset($info['statut'])?$info['statut']:'0');
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
    }

    public function find($cond){
        $sql='SELECT * FROM utilisateur';
        $a_cond=array();
        if(isset($cond)) {
            $sql.=' WHERE ';
            if (is_array($cond)) {
                foreach ($cond as $k => $v) {
                    if (!is_numeric($v)) {
                        $v = '\'' . $v . '\'';
                    }
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

}