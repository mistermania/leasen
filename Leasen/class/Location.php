<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 07/12/16
 * Time: 14:37
 */
class Location extends Model
{
    const champ=array('id_utilisateur','id_objet','date_debut','date_fin','est_accepte');
    /**
     * @param $info tableau contenant les paramètre :
     * date_debut : date du debut de la location demande
     * date_fin : date de fin de la location demande
     * id_utilisateur : id de l'utilisateur demandant la location
     * id_objet : id de l'objet que l'utilisateur veux louer
     *
     * !!!!date au format Y-m-d H:i:s
     * @return int
     * 1 : il manque des informations dans le tableau
     * 2 : aucun utilisateur ne correspond a l'id_utilisateur
     * 3 : aucune objet ne correspond a l'id de l'objet
     * 4 : la location commence avant l'instant present
     * 5 : la date de fin est avant la date de debut
     * 6 : l'objet est deja en location sur cette periode
     * 7 : presence de champ dans le tableau absent de la bdd
     * si tout c'est bien passé, retourne un tableau vide
     */
    public function insert($info)
    {
        //verifie si les champs minimums sont present
        if(!isset($info['date_debut']) or !isset($info['date_fin']) or !isset($info['id_utilisateur']) or !isset($info['id_objet']))
        {
            return 1;
        }
        //verifie si l'id de l'utilisateur est present dans la base de donnée
        $user=new Utilisateur();
        if(empty($user->find('id_utilisateur = '.$info['id_utilisateur'])))
        {
            return 2;
        }
        //verifie si l'id de l'objet est present dans la base  de donnée
        $obj = new Objet();
        if(empty($obj->find('id_objet = '.$info['id_objet'])))
        {
              return 3;
        }
        //mise des dates sous une formes standard afin de les comparer
        $now=new dateTime(date('Y-m-d H:i:s'));
        $debut=new DateTime($info['date_debut']);
        $fin=new DateTime($info['date_fin']);
        //verifie que le debut soit dans le futur
        if($now > $debut)
           {
               return 4;
           }
        //verifie que la fin soit après le debut de la location
        if($debut>$fin)
        {
            return 5;
        }
        //verifie qu'aucune location ne chevauche sur les dates demandée
        if(!empty($this->find('id_objet = '.$info['id_objet'].' AND (
        (date_debut<=\''.$info['date_debut'].'\' AND date_fin >=\''.$info['date_debut'].'\') OR
         (date_debut<=\''.$info['date_fin'].'\' AND date_fin >=\''.$info['date_fin'].'\') OR
         (date_debut>=\''.$info['date_debut'].'\' AND date_fin <=\''.$info['date_fin'].'\'))')))
        {
            return 6;
        }
        return $this->insertBdd($info);
    }

    /**
     * @param $info
     * tableau contenant les paramètre :
     * date_debut : date du debut de la location demande
     * date_fin : date de fin de la location demande
     * id_utilisateur : id de l'utilisateur demandant la location
     * id_objet : id de l'objet que l'utilisateur veux louer
     *
     * int $id : id de la location
     *
     * @return int
     * 1 : le tableau est vide
     * 7 : presence de champ en trop dans le tableau
     */

    public function update($info,$id)
    {
        foreach ($info as $k => $v)
        {
            if(!in_array($k,Location::champ))
            {
                return 1;
            }
        }
        if(isset($info['id_utilisateur']))
        {
            //verifie si l'id de l'utilisateur est present dans la base de donnée
            $user=new Utilisateur();
            if(empty($user->find('id_utilisateur = '.$info['id_utilisateur'])))
            {
                return 2;
            }
        }
        $precedent=$this->find('id_location='.$id);
        if(!isset($info['est_accepte']))
        {
            if(!isset($precedent['est_accepte']))
            {
                $info['est_accepte']='FALSE';
            }else{
                $info['est_accepte']=$precedent['est_accepte'];

            }
        }
        foreach (Location::champ as $k)
        {
            if(!isset($info[$k])){
                $info[$k]=$precedent[$k];
            }
        }
        $user=new Utilisateur();
        if(empty($user->find('id_utilisateur = '.$info['id_utilisateur'])))
        {
            return 2;
        }
        //verifie si l'id de l'objet est present dans la base  de donnée
        $obj = new Objet();
        if(empty($obj->find('id_objet = '.$info['id_objet'])))
        {
            return 3;
        }
        //mise des dates sous une formes standard afin de les comparer
        $now=new dateTime(date('Y-m-d H:i:s'));
        $debut=new DateTime($info['date_debut']);
        $fin=new DateTime($info['date_fin']);
        //verifie que le debut soit dans le futur
        if($now > $debut)
        {
            return 4;
        }
        //verifie que la fin soit après le debut de la location
        if($debut>$fin)
        {
            return 5;
        }
        //verifie qu'aucune location ne chevauche sur les dates demandée
        if(!empty($this->find('id_objet = '.$info['id_objet'].' AND (
        (date_debut<=\''.$info['date_debut'].'\' AND date_fin >=\''.$info['date_debut'].'\') OR
         (date_debut<=\''.$info['date_fin'].'\' AND date_fin >=\''.$info['date_fin'].'\') OR
         (date_debut>=\''.$info['date_debut'].'\' AND date_fin <=\''.$info['date_fin'].'\')) AND id_location !='.$id)))
        {
            return 6;
        }
        $this->updateBdd($info,$id);
    }
}