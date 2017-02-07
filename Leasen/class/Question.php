<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 28/01/17
 * Time: 21:02
 */
class Question extends Model
{
    /**
     *
     */
    const champ = array('id_question', 'contenu_question', 'date_question', 'id_objet', 'id_question_mere', 'id_utilisateur');

    /**
     * @param array $info tableau contenant les informations à inserer
     * @return int 1 si contenu_question ou id_objet n'est pas defini
     * @return int 2 si l'id de l'objet n'a pas de correspondance dans la BDD
     * @return int 3 si l'id de la question mère n'a pas de correspodance dans la BDD
     * @return int 4 si l'ide de l'utilisateeur n'a pas de correspondance dans la BDD
     */
    public function insert($info)
    {
        if (!isset($info['contenue_question']) || !isset($info['id_objet']) || !isset($info['id_utilisateur'])) {
            return 1;
        }
        $info['date_question'] = date('Y-M-D H:m:s');
        if (Model::idAbsent($info['id_objet'], 'Objet')) {
            return 2;
        }
        if (isset($info['id_question_mere'])) {
            if (Model::idAbsent($info['id_question_mere'], 'Question')) {
                return 3;
            }
        } else {
            $info['id_question_mere'] = 'NULL';
        }
        if (Model::idAbsent($info['id_utilisateur'], 'Utilisateur')) {
            return 4;
        }
        return parent::insert($info);
    }

    /**
     * @param array $info tableau contenant les informations à modifier
     * @param int $id id de la question a modifier
     * @return int 2 si l'ide de la question est absent de la BDD
     * @return int 3 si l'id de la question mere est absent de la BDD
     * @return int 4 si l'id de l'objet est absent de la BDD
     * @return int 5 si l'id de l'utilisateur est absent de la BDD
     */
    public function update($info, $id)
    {
        if (Model::idAbsent($id, 'Question')) {
            return 2;
        }
        if (isset($info['id_question_mere'])) {
            if (Model::idAbsent($info['id_question_mere'], 'Question')) {
                return 3;
            }
        }
        if (isset($info['id_objet'])) {
            if (Model::idAbsent($info['id_objet'], 'Objet')) {
                return 4;
            }
        }
        if (isset($info['id_utilisateur'])) {
            if (Model::idAbsent($info['id_utilisateur'], 'Utilisateur')) {
                return 5;
            }
        }
        return parent::update($info, $id);
    }
}