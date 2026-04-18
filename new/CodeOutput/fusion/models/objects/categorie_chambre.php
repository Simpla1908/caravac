
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        categorie_chambre_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		categorie_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_categorie_chambre.php');
	
	class categorie_chambre_model{
	
	// SELECT ALL
	 public function SelectAll($idsite) {
            $requete = "SELECT * FROM categorie_chambre k WHERE k.del=0 AND k.hotel_id=:id ORDER BY k.lib_cat_cha  ASC";
            $query = HDB::hus()->prepare($requete);
            $query->BindParam(':id', $idsite);
            try {
                $query->execute();
                return $query->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("categorie_chambre");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("categorie_chambre","id_cat_cha=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("categorie_chambre","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE categorie_chambre");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("categorie_chambre","id_cat_cha=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($lib_cat_cha,$hotel_id)
	{
	
	$values = array(array( 'lib_cat_cha'=>$lib_cat_cha,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('categorie_chambre', $values);
	}
	
	// UPDATE
	public function Update($lib_cat_cha,$hotel_id,$id)
	{
	$sql = "  lib_cat_cha =:lib_cat_cha,hotel_id =:hotel_id WHERE id_cat_cha = :id ";
	$data = array(':lib_cat_cha'=>$lib_cat_cha,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('categorie_chambre',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	