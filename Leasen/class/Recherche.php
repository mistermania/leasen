<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 08/01/17
 * Time: 10:52
 */
class Recherche extends Model
{

    /**
     * Recherche constructor.
     * @param $info
     * tableau contenant les information suivantes ;
     * id_type
     * chaine
     * date_debut
     * duree (en jour)
     */
    public function effectueRecherche($info)
    {
        //ajout du 1=1 pour simplifier l'ajout des AND, car aucune des conditions auouté ci dessous ne seras la première
        $requete=' 1=1 ';
        if(isset($info['id_type']))
        {
            if($info['id_type'] != 0) {
                //l'egalite avec le type
                $requete .= ' AND id_type=' . $info['id_type'] . ' ';
            }
            }
        if(isset($info['chaine']))
        {
            //verifie que la chaine souhaité est contenu dans le nom de l'objet
            $requete.= 'AND nom_objet ILIKE \'%'.$info['chaine'].'%\'';
        }
        //verifie la disponibilité de l'objet au dates renseignées
        if(isset($info['date_debut']) AND isset($info['duree'])) {
            if (!empty($info['date_debut']) AND !empty($info['duree'])) {//creation d'un ojet datetime pour permettre l'ajout de la duree
                $date = new DateTime($info['date_debut']);
                // duréee transformé en un objet date interval ( durée en jour
                $duree = new DateInterval('P' . $info['duree'] . 'D');
                $info['date_fin'] = $date->add($duree)->format('Y-m-d H:i:s');
                $requete .= ' AND (NOT ((date_debut<=\'' . $info['date_debut'] . '\' AND date_fin >=\'' . $info['date_debut'] . '\') OR
         (date_debut<=\'' . $info['date_fin'] . '\' AND date_fin >=\'' . $info['date_fin'] . '\') OR
         (date_debut>=\'' . $info['date_debut'] . '\' AND date_fin <=\'' . $info['date_fin'] . '\')) OR (date_debut IS NULL OR date_fin IS NULL))';
            }
        }
        return $this->find($requete);
    }
}