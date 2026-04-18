
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        rescategorie_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		rescategorie
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	//include_once(APP_FOLDER.'/models/classes/class_rescategorie.php');
	
	class facconditionpaie_model{
	
	// SELECT ALL
	public function SelectAll($idsite)
	{
            $requete='SELECT * FROM condition_reglement AS a WHERE a.site_id=:id';
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id', $idsite);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            } 
	}
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("condition_reglement","id=:id",$bind);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("condition_reglement","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($des,$njrs,$site_id)
	{
	
	$values = array(array( 'des'=>$des,'njrs'=>$njrs,'site_id'=>$site_id ));
	HDB::hus()->Hinsert('condition_reglement', $values);
	}
	
	// UPDATE
	public function Update($des,$njrs,$site_id,$id)
	{
	$sql = "  des =:des,njrs =:njrs,site_id =:site_id WHERE id = :id ";
	$data = array(':des'=>$des,':njrs'=>$njrs,':site_id'=>$site_id,':id'=>$id);
	HDB::hus()->Hupdate('condition_reglement',$sql,$data);
	
	}
	

	} // end class
	
	?>
	
	