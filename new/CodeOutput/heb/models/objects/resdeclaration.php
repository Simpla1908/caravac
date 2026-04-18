
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        reshoraire_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		reshoraire
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	//include_once(APP_FOLDER.'/models/classes/class_resdeclaration.php');
	
	class resdeclaration_model{
	// SELECT
	public function Select($site_id)
	{
    $requete = 'SELECT * FROM  resdeclaration WHERE site_id=:site_id ORDER BY id';
    $query = HDB::hus()->prepare($requete);
    $query->BindParam(':site_id', $site_id);
    try {
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
	return $result; 
	}
	// UPDATE
	public function Update($lib,$pourtrav,$poursoc,$id)
	{
	$sql = "lib =:lib,pourtrav =:pourtrav,poursoc =:poursoc WHERE id = :id";
	$data = array(':lib'=>$lib,'pourtrav'=>$pourtrav,'poursoc'=>$poursoc,':id'=>$id);
	HDB::hus()->Hupdate('resdeclaration',$sql,$data);
	
	}
	public function DatasFromTEmploy($datedebut,$datefin,$site_id)
	{
	 $requete='SELECT a.*,b.*,c.libelle AS fonction,d.libelle AS departement,
                    e.libelle AS categorie,e.id AS idcat,e.salbase,e.devise,e.montantjr
                    FROM  resemployes  AS a, rescontrat AS b, resfonction AS c,resdepartement AS d,rescategorie AS e
                         WHERE a.id=b.employe_id 
                         AND a.fonction_id=c.id 
                         AND a.departement_id=d.id
                         AND c.categorie_id=e.id
                         AND (b.dteng>=:datedebut OR b.dteng<=:datefin)
                         AND a.id_hotel=:id
                         ORDER BY a.noms';
        $query = HDB::hus()->prepare($requete);
        $query->BindParam(':datedebut',$datedebut);
        $query->BindParam(':datefin',$datefin);
        $query->BindParam(':id',$site_id);
        try {
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
	}

	} // end class
	
	?>
	
	