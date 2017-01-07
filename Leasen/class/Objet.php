<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 07/12/16
 * Time: 22:21
 */
class Objet extends  Model
{
    const champ=array('nom_objet','description_objet','a_une_caution','prix_caution','est_payant','prix','o_est_affiche','id_utilisateur','id_type');
    public function insert($info)
    {
        if(!isset($info['nom_objet']) OR !isset($info['description_objet']) OR !isset($info['id_utilisateur']) )
        {
            return 1;
        }
        $user =new Utilisateur();
        $cond =array('id'=>$info['id_utilisateur']);
        if(empty($user->find($cond))){
            return 1;
        }
        $this->insertBdd($info);
        return 0;
    }

}