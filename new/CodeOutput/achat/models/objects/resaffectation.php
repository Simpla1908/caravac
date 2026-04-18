
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        resaffectation_model
	* DATE CREATED:  	30-10-2017
	* FOR TABLE:  		resaffectation
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_resaffectation.php');
	
	class resaffectation_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("resaffectation LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("resaffectation");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("resaffectation");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("resaffectation","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("resaffectation","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE resaffectation");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("resaffectation","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($libelle,$site_id)
	{
	
	$values = array(array( 'libelle'=>$libelle,'site_id'=>$site_id ));
	HDB::hus()->Hinsert('resaffectation', $values);
	}
	
	// UPDATE
	public function Update($libelle,$site_id,$id)
	{
	$sql = "  libelle =:libelle,site_id =:site_id WHERE id = :id ";
	$data = array(':libelle'=>$libelle,':site_id'=>$site_id,':id'=>$id);
	HDB::hus()->Hupdate('resaffectation',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	