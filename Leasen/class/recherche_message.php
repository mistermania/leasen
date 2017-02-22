<?php

class recherche_message extends Model {

    public function effectueRecherche($info) {
        $requete = 'id_utilisateur = ' . $info['id_utilisateur'] . 'AND statut_location = 1';
        return $this->find($requete, ' date_debut DESC');
    }
}

