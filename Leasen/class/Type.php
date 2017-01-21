<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 13/12/16
 * Time: 15:06
 */
class Type extends Model
{
    const champ=array('description_type');

		/**
		*@param $i tableau contenant les champs à inserer
		*@return 1 : description_type non defini
		*@return 7 : clé incorrecte dans le tableau
		*/
		public function FunctionName($i)
		{
			if(!isset($i['description_type']))
			{
				return 1;
			}
			return $this->insertBdd($i);
		}
}
