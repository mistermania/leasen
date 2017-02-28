<?php

/**
 * Class recherche_message
 */
class recherche_message extends Model {


    /**
     * @param array $info tableau contenant l'id de l'utilisateur
     * @return array tableau contenant les demandes de locations
     */
    public function effectueRecherche($info) {
        $requete = 'id_utilisateur = ' . $info['id_utilisateur'] . 'AND statut_location = 1';
        return $this->find($requete, ' date_debut DESC');
    }
}

