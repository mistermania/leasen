<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 07/12/16
 * Time: 22:21
 */
class Objet extends Model
{
    /**
     * @var array contenant le nom des colonnes de la table
     */
    const champ = array('nom_objet', 'description_objet', 'a_une_caution', 'prix_caution', 'est_payant', 'prix', 'o_est_affiche', 'id_utilisateur', 'id_type','url_photo');

    /**
     * @param array $info : tableau contenant les valeurs à inserer
     * @return int
     * 1 : nom_objet, description_objet ou id_utilisateur non defini
     * 2 : aucun utilisateur ne correspond a id_utilisateur
     * 3 : pas de type correspondant a id_type
     * 6 : le prix n'est pas un nombre
     * 7 : clé incorrecte dans $info
     * 8 : prix_caution n'est pas un nombre
     */
    public function insert($info)
    {
        if (!isset($info['nom_objet']) OR !isset($info['description_objet']) OR !isset($info['id_utilisateur'])) {
            return 1;
        }
        if (Model::idAbsent($info['id_utilisateur'], 'Utilisateur')) {
            return 2;
        }
        if (isset($info['id_type'])) {
            if (Model::idAbsent($info['id_type'], 'Type')) {
                return 3;
            }
        }
        if (isset($info['o_est_affiche'])) {
            if ($info['o_est_affiche']) {
                $info['o_est_affiche'] = 'TRUE';
            } else {
                $info['o_est_affiche'] = 'FALSE';
            }
        } else {
            $info['o_est_affiche'] = 'TRUE';
        }
        if (isset($info['prix'])) {
            // si le prix n'est pas un nombre
            if (is_nan($info['prix'])) {
                return 6;
            }
            if ($info['prix'] <= 0) {
                $info['est_payant'] = 'FALSE';
                $info['prix'] = 0;
            } else {
                $info['est_payant'] = 'TRUE';
            }
        } else {
            $info['est_payant'] = 'FALSE';
        }
        if (isset($info['prix_caution'])) {
            // si le prix de la caution n'est pas un nombre
            if (is_nan($info['prix_caution'])) {
                return 8;
            }
            if ($info['prix_caution'] <= 0) {
                $info['a_une_caution'] = 'FALSE';
                $info['prix_caution'] = 0;
            } else {
                $info['a_une_caution'] = 'TRUE';
            }

        } else {
            $info['a_une_caution'] = 'FALSE';
            $info['prix_caution'] = 0;
        }
        parent::insert($info);
        return 0;
    }


    /**
     * @param $info
     * tableau contenant les info a modifier
     * @param $id
     * id de l'objet
     * @return int
     * 1 : si il y a des clefs incorecte dans le tableau
     * 2 : si le nouvelle id_utilisateur n'est pas present dans la table utilisateur
     * 3 : si le nouvelle id_type n'est pas present dans le table type
     */
    public function update($info, $id)
    {
        if (Model::idAbsent($id, 'Objet')) {
            return 2;
        }
        if (isset($info['id_type'])) {
            if (Model::idAbsent($info['id_type'], 'Type')) {
                return 3;
            }
        }
        if (isset($info['o_est_affiche'])) {
            if ($info['o_est_affiche']) {
                $info['o_est_affiche'] = 'TRUE';
            } else {
                $info['o_est_affiche'] = 'FALSE';
            }
        } else {
            $info['o_est_affiche'] = 'TRUE';
        }
        return parent::update($info, $id);
    }
}