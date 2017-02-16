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
     * @return mixed
     */
    public function effectueRecherche($info)
    {     
        $requete = 'id_utilisateur = '.$info['id_utilisateur'];
        return $this->find($requete, ' date_debut DESC');
    }
}
