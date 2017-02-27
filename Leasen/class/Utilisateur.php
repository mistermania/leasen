<?php
/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 06/12/16
 * Time: 09:30
 */
class Utilisateur extends Model
{
    /**
     * @var array contenant le nom des colonnes de la table
     */
    const champ = array('nom', 'prenom', 'e_mail', 'partager_telephone', 'telephone', 'hash_mot_de_passe', 'est_ban', 'raison_ban', 'token_regeneration', 'date_token', 'date_creation_compte', 'statut');

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
    public function insert($info)
    {
        if (!isset($info['nom']) or !isset($info['prenom']) or !isset($info['e_mail']) or !isset($info['mot_de_passe'])) {
            //si les informations minimales ne sont pas remplies.
            return 1;
        }
        if (isset($info['telephone'])) {
            if (!$this->estValideTelephone($info['telephone'])) {
                return 2;
            }
            $cond_tel = array('telephone' => $info['telephone']);
            if (!empty($this->find($cond_tel))) {
                return 6;
            }
        } else {
            //on prepare le champ pour le rentrer dans la BDD
            $info['telephone'] = 'NULL';
        }
        //si l'adresse email ne correspond pas au paterne attendu
        if (!$this->estValideMail($info['e_mail'])) {
            return 3;
        }
        //si le mot de passe contient moins de 8 caractère, dont une minuscule, une majuscule et un chiffre
        if ($debug = 0) {
            if (!$this->estValideMotDePasse($info["mot_de_passe"])) {
                return 4;
            }
        }
        $cond = array('e_mail' => $info['e_mail']);
        $mail = $this->find($cond);
        //si l'email est present dans la base de donnée
        if (!empty($mail)) {
            return 5;
        }
        if (isset($info['partager_telephone'])) {
            if ($info['partager_telephone']) {
                $info['partager_telephone'] = 'TRUE';
            } else {
                $info['partager_telephone'] = 'FALSE';
            }
        } else {
            $info['partager_telephone'] = 'FALSE';
        }
        //on modifie les elements du tableau pour les rentrer proprement dans la BDD
        //on hash le mot de passe
        $info['hash_mot_de_passe'] = password_hash($info['mot_de_passe'], PASSWORD_DEFAULT);
        //on supprime le mot de passe du tableau
        unset($info['mot_de_passe']);
        //on passe en lowercase le nom
        $info['nom'] = strtolower($info['nom']);
        //et le prenom
        $info['prenom'] = strtolower($info['prenom']);
        //on ajoute la date de creation
        $info['date_creation_compte'] = date('Y-m-d');
        //un nouvel utilisateur est TOUJOURS un utilisateur lambda
        $info['statut'] = 0;
        return parent::insert($info);
    }

    /**
     * @param array $info tableau contenant les information a modifier
     * @param int $id : id de l'utilisateur
     * @return int 1 : info contient des champs absent de la bdd
     * @return int 2 :le numero de telephone n'est pas un numero de telpehone valide
     * @return int 3 : adresse mail invalide
     * @return int 4 : mot de passe trop faible (moins de 8 caractère, absence d'une chiffre, d'une majuscule et d'une minuscule
     * @return int 5 : adresse déja presente dans la base de donnée
     * @return int 6 : numero deja present dans la base de donnée
     * @return int 0 : insertion reussie
     */
    public function update($info, $id)
    {
        if (isset($info['mot_de_passe'])) {
            if (!$this->estValideMotDePasse($info['mot_de_passe'])) {
                return 4;
            }
            $info['hash_mot_de_passe'] = password_hash($info['mot_de_passe'], PASSWORD_DEFAULT);
            unset($info['mot_de_passe']);
        }
        foreach ($info as $k => $v) {
            if (!in_array($k, Utilisateur::champ)) {
                return 1;
            }
        }
        if (isset($info['e_mail'])) {
            if (!$this->estValideMail($info['e_mail'])) {
                return 3;
            }
            $cond = ' e_mail= ' .$this->pdo->quote($info['e_mail']). ' AND id_utilisateur !='.$this->pdo->quote($id);
            $mail = $this->find($cond);
            //si l'email est present dans la base de donnée
            if (!empty($mail)) {
                return 5;
            }
        }
        if (isset($info['telephone'])) {
            if (!$this->estValideTelephone($info['telephone'])) {
                return 2;
            }
            $cond_tel = ' telephone=' . $this->pdo->quote($info['telephone']). ' AND id_utilisateur !='.$this->pdo->quote($id);
            if (!empty($this->find($cond_tel))) {
                return 6;
            }
        }
        if (isset($info['partager_telephone'])) {
            if ($info['partager_telephone']) {
                $info['partager_telephone'] = 'TRUE';
            } else {
                $info['partager_telephone'] = 'FALSE';
            }
        }
        return parent::update($info, $id);
    }
}