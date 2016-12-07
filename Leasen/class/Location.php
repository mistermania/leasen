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
    public function createLocation($info)
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
         (date_debut<=\''.$info['date_fin'].'\' AND date_fin >=\''.$info['date_fin'].'\') )')))
        {
            return 6;
        }
        return $this->createLocationBdd($info);
    }

    /**
     * @param $info
     * tableau contenant les paramètre :
     * date_debut : date du debut de la location demande
     * date_fin : date de fin de la location demande
     * id_utilisateur : id de l'utilisateur demandant la location
     * id_objet : id de l'objet que l'utilisateur veux louer
     *
     * @return int
     * 1 : le tableau est vide
     * 7 : presence de champ en trop dans le tableau
     */
    private function createLocationBdd($info){
        if(empty($info))
        {
            return 1;
        }
        //liste des champs pouvant etres present
        $champ=array('id_utilisateur','id_objet','date_debut','date_fin','est_accepte');
        foreach ($info as $k => $v)
        {
            //si une clé ne fait pas partie de la liste
            if(!in_array($k,$champ))
            {
                //on sort
                return 7;
            }
        }
        $debut='INSERT INTO location (id_location';
        $fin = ' VALUES ((SELECT max(id_location)+1 FROM location)';
        foreach ($info as $k=>$v)
        {
            //la clé est inserer comme colonne de la table
            $debut.=','.$k;
            //la valeur est ajoute dans les values
            $fin.=', \''.$v.'\'';
        }
        //ajout de ponctuation
        $debut.=')';
        $fin.=') ;';
        //la requete totale est la concatenation des deux requete qui ont été preparé
        $req=$this->pdo->prepare($debut.$fin);
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