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
     * @return int 0 : insertion reussie
     */
    public function createUser($info)
    {

        if(!isset($info['nom']) or !isset($info['prenom']) or !isset($info['email']) or !isset($info['mot_de_passe'])) )
        {
            //si les informations minimales ne sont pas remplies.
            return 1;
        }
        if(isset($info['telephone'])?!$this->est_valide_telephone($info['telephone']):false) {
            echo 'numero de merde';
            return 2;
        }
        //si l'adresse email ne correspond pas au paterne attendu
        if(!$this->est_valide_mail($info['email']))
        {
            return 3;
        }

        //si le mot de passe contient moins de 8 caractère, dont une minuscule, une majuscule et un chiffre
        if (!$this->est_valide_mot_de_passe($info["mot_de_passe"])) {
            return 4;
        }
        $cond=array('e_mail'=> $info['email']);
        $mail=$this->find($cond);
        //si l'email est absent de la base de donnée
        if(empty($mail)) {
            return $this->insertUser($info);

        }else{
            // si il est déja present
            return 5;
        }
    }

    /**
     * @param array $info
     * @return int 0: tout c'est bien passés
     *
     * ajout un utilisateur a la base de donnée
     */
    private function insertUser($info)
    {
        //chiffrement du mot de passe
        $hash=password_hash($info['mot_de_passe'],PASSWORD_DEFAULT);
        $sql='INSERT INTO utilisateur (id_utilisateur,nom,prenom,date_creation_compte,e_mail,partager_telephone,telephone,hash_mot_de_passe,statut) VALUES ( ';
        $sql.='(SELECT max(id_utilisateur)+1 FROM utilisateur)';
        $sql.=',\''.strtolower($info['nom']).'\'';
        $sql.=',\''.strtolower($info['prenom']).'\'';
        $sql.=',\''.date('Y-m-d').'\'';
        $sql.=',\''.$info['email'].'\'';
        $sql.=','.(isset($info['partager_telephone'])?$info['partager_telephone']:'NULL');
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
        return 0;
    }

    /**
     * @param mixed $cond
     * si $cond est un tableau, ajout a la requete de condtion where clé==valeur pour chaque couple clé valeur
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

    public function updateInfo($info)
    {

    }
}