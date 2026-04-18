
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        reglage_systeme_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		reglage_systeme
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_reglage_systeme.php');
	
	class reglage_systeme_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("reglage_systeme LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("reglage_systeme");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("reglage_systeme");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("reglage_systeme","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("reglage_systeme","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE reglage_systeme");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("reglage_systeme","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($tva)
	{
	
	$values = array(array( 'tva'=>$tva ));
	HDB::hus()->Hinsert('reglage_systeme', $values);
	}
	
	// UPDATE
	public function Update($tva,$id)
	{
	$sql = "  tva =:tva WHERE id = :id ";
	$data = array(':tva'=>$tva,':id'=>$id);
	HDB::hus()->Hupdate('reglage_systeme',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	