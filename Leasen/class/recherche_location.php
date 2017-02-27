<?php
/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 08/01/17
 * Time: 10:52
 */
class recherche_location extends Model
{
    /**
     * Recherche constructor.
     * @param $info
     * tableau contenant les information suivantes ;
     * id_type
     * chaine
     * date_debut
     * duree (en jour)
     * @param $limit
     * nombre d'elements a affiché
     * @return array
     */
    public function effectueRecherche($info, $limit = 50)
    {     
        $requete = 'id_utilisateur = '.$info['id_utilisateur'].'AND statut_location = 2';
        return $this->find($requete,' date_debut DESC', $limit);
    }
}