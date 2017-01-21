<?php
/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 07/12/16
 * Time: 14:37
 */
class Demande_objet extends Model
{
	const champ=array('date_demande_objet','description_objet','titre_demande',id_utilisateur,id_type);

/**
*@param $i : tableau contenant les champs a inserer
* @return 1 : id_utilisateur, description_objet ou titre_demande non renseignée
*@return 2 :id_utilisateur absent de la Bdd
*@return 3 : id_type absent de la Bdd
*@return 7 : clé incorrecte dans le tableau
*/
	public function insert($i)
	{
		if(!isset($i['id_utilisateur']) || !isset($i['description_objet']) || !isset(['titre_demande']))
		{
			return 1;
		}

		$i['date_demande_objet']=date('Y-m-d');
		if(Model::idAbsent($i['id_utilisateur'],'Utilisateur'))
		{
			return 2;
		}
		if(Model::idAbsent($i['id_type'],'Type'))
		{
			return 3;
		}

		return $this->insertBdd($i);
	}

}
?>
