<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 07/12/16
 * Time: 14:37
 */
class Location extends Model
{
    /**
     * @var array contenant le nom des colonnes de la table
     */
    const champ=array('id_utilisateur','id_objet','date_debut','date_fin','statut_location');
    /**
     * @param array $info tableau contenant les paramètre :
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
     * 8 : aucune location ne correspond a l'id
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
        if(Model::idAbsent($info['id_utilisateur'],'Utilisateur'))
        {
            return 2;
        }
        //verifie si l'id de l'objet est present dans la base  de donnée
        if(Model::idAbsent($info['id_objet'],'Objet'))
        {
              return 3;
        }
        //mise des dates sous une formes standard afin de les comparer
        $now=new dateTime(date('Y-m-d'));
        $debut=new DateTime($info['date_debut']);
        //verifie que le debut soit dans le futur
        if($now > $debut)
           {
               return 4;
           }
        //verifie que la fin soit après le debut de la location
        $a=$this->estDisponible($info['date_debut'],$info['date_fin'],$info['id_objet']);
        if($a==1)
        {
            return 5;
        }
        //verifie qu'aucune location ne chevauche sur les dates demandée
        if($a==2)
        {
            return 6;
        }
        $info['statut_location']=1;
        return $this->insertBdd($info);
    }

    /**
     * @param $info
     * tableau contenant les paramètre :
     * date_debut : date du debut de la location demande
     * date_fin : date de fin de la location demande
     * id_utilisateur : id de l'utilisateur demandant la location
     * id_objet : id de l'objet que l'utilisateur veux louer
     * statut_location
     *
     * @param int $id : id de la location
     *
     * @return int
     *  * 1 : il manque des informations dans le tableau
     * 2 : aucun utilisateur ne correspond a l'id_utilisateur
     * 3 : aucune objet ne correspond a l'id de l'objet
     * 4 : la date de debut est dans le passé (si elle à été modifié)
     * 5 : la date de fin est avant la date de debut
     * 6 : l'objet est deja en location sur cette periode
     * 7 : presence de champ dans le tableau absent de la bdd
     */

    public function update($info,$id)
    {
        if(Model::idAbsent($id,'Location'))
        {
            return 8;
        }
        foreach ($info as $k => $v)
        {
            if(!in_array($k,Location::champ))
            {
                return 1;
            }
        }
        //recuperation des informations précedente
        $precedent=$this->find('id_location='.$id);
        foreach (Location::champ as $k)
        {
            if(!isset($info[$k])){
                //si aucune information n'a été transmise, on récupère la précédente
                $info[$k]=$precedent[$k];
            }
        }
        //verifie si l'id de l'objet est present dans la base  de donnée
        if(Model::idAbsent($info['id_objet'],'Objet'))
        {
            return 3;
        }
        //verifie si l'id de l'utilisateur est present dans la base de donnée
        if(Model::idAbsent($info['id_utilisateur'],'Utilisateur'))
        {
            return 2;
        }

        //mise des dates sous une formes standard afin de les comparer
        if($info['date_debut']!=$precedent['date_debut']) {
            $now = new dateTime(date('Y-m-d'));
            $debut = new DateTime($info['date_debut']);
            //verifie que le debut soit dans le futur
            if ($now > $debut) {
                return 4;
            }
        }
        //verifie que la fin soit après le debut de la location
        $a=$this->estDisponible($info['date_debut'],$info['date_fin'],$info['id_objet'],$id);
        if($a==1)
        {
            return 5;
        }
        //verifie qu'aucune location ne chevauche sur les dates demandée
        if($a==2)
        {
            return 6;
        }
        if($info['statut_location']>4 || $info['statut_location']<0 || !is_int($info['statut_location']))
        {
            return 8;
        }
        return $this->updateBdd($info,$id);
    }

    /**
     * @param $dateDebut string du debut de la location
     * @param $dateFin string contenant la date de fin de la location
     * @param $idObjet int id de l'objet
     * @param $idLoc int id de location à ne pas prendre en compte
     * @return int 0 si l'objet est disponible
     * @return int 1 si la date de fin est superieur a celle du début
     * @return int 2 si l'objet n'est pas disponible
     * @return int 4 si $idObjet ou $idLoc ne sont pas des entier
     */
    public function estDisponible($dateDebut, $dateFin, $idObjet, $idLoc=0)
    {
        $debut=new DateTime($dateDebut);
        $fin=new DateTime($dateFin);
        if($fin<$debut)
        {
            return 1;
        }
        if(is_nan($idObjet)|| is_nan($idLoc))
        {
            return 4;
        }
        $dateDebut=$this->pdo->quote($dateDebut);
        $dateFin=$this->pdo->quote($dateFin);
        if(empty($this->find('id_objet = '.$idObjet.' AND (
        (date_debut<='.$dateDebut.' AND date_fin >='.$dateDebut.') OR
         (date_debut<='.$dateFin.' AND date_fin >='.$dateFin.') OR
         (date_debut>='.$dateDebut.' AND date_fin <='.$dateFin.')) AND id_location !='.$idLoc.' AND statut_location != 2')))
        {
            return 0;
        }else{
            return 2;
        }
    }
}


