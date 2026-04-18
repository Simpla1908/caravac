
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        niveau_chambre_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		niveau_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_niveau_chambre.php');
	
	class niveau_chambre_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("niveau_chambre LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("niveau_chambre");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("niveau_chambre");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("niveau_chambre","id_niv_cha=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("niveau_chambre","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE niveau_chambre");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("niveau_chambre","id_niv_cha=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($lib_niv_cha,$hotel_id)
	{
	
	$values = array(array( 'lib_niv_cha'=>$lib_niv_cha,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('niveau_chambre', $values);
	}
	
	// UPDATE
	public function Update($lib_niv_cha,$hotel_id,$id)
	{
	$sql = "  lib_niv_cha =:lib_niv_cha,hotel_id =:hotel_id WHERE id_niv_cha = :id ";
	$data = array(':lib_niv_cha'=>$lib_niv_cha,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('niveau_chambre',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	