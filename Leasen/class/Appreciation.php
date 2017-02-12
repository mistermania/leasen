<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 06/02/17
 * Time: 20:49
 */
class Appreciation extends  model
{

    const champ = array('id_appreciation','notes','commentaire','a_est_affiche','statut_appreciation','id_location');


    /**
     * @param $info array
     * @return int 1 si id_location ou statut_appreciation n'est pas renseignée
     * @return int 2 si id_location n'a pas de correspondance dans la bbd
     * @return int 1 si statut_appreciation a une valeur differente de 1 ou 2
     * @return int 4 si la notes n'est pas comprise entre 0 et 5
     */
    public function insert($info)
    {
        if(!isset($info['$id_location']) || !isset($info['staut_appreciation']))
        {
            return 1;
        }
        if(Model::idAbsent($info['id_location'],'Location'))
        {
            return 2;
        }
        if($info['staut_appreciation']!=1 && $info['staut_appreciation']!=2)
        {
            return 3;
        }
        if(isset($info['a_est_affiche']))
        {
            if($info['a_est_affiche'])
            {
                $info['a_est_affiche']='TRUE';
            }else{
                $info['a_est_affiche']='FALSE';
            }

        }else{
            $info['a_est_affiche']='TRUE';
        }

        if(isset($info['notes']))
        {
            if($info['notes']<0 || $info['notes']>5)
            {
                return 4;
            }
        }

        return parent::insert($info);
    }

    public function update($info, $id)
    {
        return parent::update($info, $id);
    }
}