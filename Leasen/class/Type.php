<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 13/12/16
 * Time: 15:06
 */
class Type extends Model
{
    /**
     * @var array contenant le nom des colonnes de la table
     */
    const champ = array('description_type');

    /**
     * @param array $i tableau contenant les champs à inserer
     * @return int 1 : description_type non defini
     * @return int 7 : clé incorrecte dans le tableau
     */
    public function insert($i)
    {
        if (!isset($i['description_type'])) {
            return 1;
        }
        return parent::insert($i);
    }
}