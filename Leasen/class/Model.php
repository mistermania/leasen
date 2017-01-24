<?php

/**
 * Created by PhpStorm.
 * User: billaud
 * Date: 05/12/16
 * Time: 20:47
 */
abstract class  Model
{
    /**
     * @var
     * variable contenant toutes les connections
     */
    public static $connection;
    /**
     * @var PDO
     * variable contenant la connection de l'objet
     */
    protected $pdo;
    /**
     *@var array contenant le noms de toutes les tables
     */
    const nomTable = array('Utilisateur','Location','Demande_objet','Type','Objet','Demande_objet');

    /**
     * @var array contenant le nom des champs dans chaque table
     */
    const champ=array('id');
    /**
     * Model constructor.
     */
    public function __construct(){
        $conf = Config::$config;
        //si la connection n'a pas déjà été crée
        if(!isset(Model::$connection[$conf['DB_NAME']]))
        {
            try {
                //essaye de créer la nouvelle connection
                $db = new  PDO('pgsql:host='.$conf['HOST'].';dbname=' . $conf['DB_NAME'] . ';user='. $conf['USER'].';password='.$conf['PASSWORD']);
                if (Config::$debug >= 1) {
                    //change le mode d'erreur, pour qu'il affiche les erreur a l'interieur de la bdd
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                }
                Model::$connection[$conf['DB_NAME']]= $db;
                $this->pdo=$db;
            } catch (PDOException $e) {
                if (Config::$debug >= 1) {
                    echo $e->getMessage();

                } else {
                    echo 'bdd indispo';
                }
            };
        }else{

            $this->pdo=Model::$connection[$conf['DB_NAME']];
        }

    }


    /**
     * @param string $mail adresse mail a verifier
     * @return bool true si l'adresse est valide, false si non
     */
    public function estValideMail($mail)
    {
        $regexp_mail="/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@]isen.yncrea.fr$/";
        if(isset($mail))
        {
            if(preg_match($regexp_mail,$mail))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $telephone numero de telelephone a verifier
     * @return bool true si il est valide, false si non
     */
    public function estValideTelephone($telephone)
    {
        $regexp_telephone="/^([+]([1-9]){1,3}|0)[1-79]([-. ]?[0-9]){8}$/";
        if(isset($telephone))
        {
            if(preg_match($regexp_telephone,$telephone))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $mot_de_passe mot_de_passe a verifier
     * @return bool true si il contient au moins 8 caractère, majuscule, une minuscule et un chiffre
     */
    public function estValideMotDePasse($mot_de_passe)
    {
        $regexp_mot_de_passe ="/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/";
        if(isset($mot_de_passe))
        {
            if(preg_match($regexp_mot_de_passe,$mot_de_passe))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @param mixed $cond
     * si $cond est un tableau, ajout a la requete de condtion where clé=valeur pour chaque couple clé valeur
     * sinon ajout de la conditon après le where
     * recherche dans la table/vue portant le nom de l'objets
     * @param String $order strin contenant les critère concernant l'ordre des resultats ex : id ASC,date DESC
     * @return mixed: tableau contenant les information des utilisateurs repondant aux condition
     */

    public function find($cond,$order=""){
        $sql='SELECT * FROM '.get_class($this);

        $a_cond=array();
        if(isset($cond)) {
            $sql.=' WHERE ';
            if (is_array($cond)) {
                foreach ($cond as $k => $v) {
                    //if (!is_numeric($v)) {
                    $v =$this->pdo->quote($v) ;
                    //}
                    $a_cond[]="$k = $v";
                }
                $sql.=implode(' AND ',$a_cond);

            } else {
                $sql .= $cond;
            }
        }
        // echo $sql.'<br>';
        if($order!="")
        {
            $sql.="ORDER BY ".$order;
        }
        $req=$this->pdo->prepare($sql);
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
        //retourne un tableau contenant les information.
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param array $info tableau contenant les informations a modifier
     * @param int $id id a modifier
     * @return int 0 si la modification a été effectue
     * @return int 1 si trop de clé dans le tableau
     */
    protected function updateBdd($info, $id)
    {
        $sql='UPDATE '.get_class($this).' SET ';
            foreach ($info as $k => $v)
            {
                //si une clé ne fait pas partie de la liste
                if(!in_array($k,$this::champ))
                {
                    //on sort
                    return 7;
                }
            }
            foreach ($info as $k => $v) {
                $sql .=$k . ' = '.$this->pdo->quote($v).',';
            }
            //on enleve la dernière virgule
            $sql=substr($sql, 0, -1);
            $sql.=' WHERE id_'.get_class($this).' = '.$id;
            echo $sql;
            $req=$this->pdo->prepare($sql);
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
            $req->fetchAll(PDO::FETCH_ASSOC);
            return 0;
    }

    /**
     * @param $info
     * @return int 0 si l'insertion a été effectue
     * @return int 7 si trop de clé dans le tableau
     */
    protected function insertBdd($info){
        foreach ($info as $k => $v)
        {
            //si une clé ne fait pas partie de la liste
            if(!in_array($k,$this::champ))
            {
                //on sort
                return 7;
            }
        }
        $debut='INSERT INTO '.get_class($this).'(id_'.get_class($this);
        $fin = ' VALUES ((SELECT max(id_'.get_class($this).')+1 FROM '.get_class($this).')';
        foreach ($info as $k=>$v)
        {
            //la clé est inserer comme colonne de la table
            $debut.=','.$k;
            //la valeur est ajoute dans les values
            $fin.=','.$this->pdo->quote($v);
        }
        //ajout de ponctuation
        $debut.=')';
        $fin.=') ;';
        //la requete totale est la concatenation des deux requete qui ont été preparé
        if(Config::$debug>0)
        {
            echo $debut.$fin.'<br>';
        }
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
        $req->fetchAll(PDO::FETCH_ASSOC);
        return 0;
    }
/**
 * fontion servant a savoir si un id existe dans un table donnée
 *
 *
 * @param int $id : id  dont il faut verifier l'existence dans la table
 * @param string $table nom de la table
 * @return int 1 : id absent
 *										0 : id present
 *										2 : nom de table erronée
 */
		 static function idAbsent($id,$table)
		{
			if(in_array($table,Model::nomTable))
			{
                /**
                 * @var Model $obj
                 */
				$obj=new $table();
				if(empty($obj->find('id_'.$table.'= '.$id)))
				{
							return 1;
				}
				else {
					return 0;
				}
			}else {
				return 2;
			}

		}
}
