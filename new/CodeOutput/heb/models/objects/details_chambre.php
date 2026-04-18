
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        details_chambre_model
	* DATE CREATED:  	25-11-2019
	* FOR TABLE:  		details_chambre
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_details_chambre.php');
	
	class details_chambre_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("details_chambre LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("details_chambre");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("details_chambre");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("details_chambre","id_detail=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("details_chambre","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE details_chambre");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("details_chambre","id_detail=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($icon,$designation)
	{
	
	$values = array(array( 'icon'=>$icon,'designation'=>$designation ));
	HDB::hus()->Hinsert('details_chambre', $values);
	}
	
	// UPDATE
	public function Update($icon,$designation,$id)
	{
	$sql = "  icon =:icon,designation =:designation WHERE id_detail = :id ";
	$data = array(':icon'=>$icon,':designation'=>$designation,':id'=>$id);
	HDB::hus()->Hupdate('details_chambre',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	