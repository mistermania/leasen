<?php

/**
 * Class recherche_question
 */
class recherche_question extends Model {


    /**
     * @param array $info tableau contenant l'id de l'objet
     * @return array tableau contenant les demandes de locations
     */
    public function effectueRecherche($info) {
        $requete = 'id_objet = ' . $info['id_objet'] ;
        return $this->find($requete, ' date_question DESC');
    }
}

