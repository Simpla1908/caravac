
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        t_mode_reglement_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		t_mode_reglement
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_t_mode_reglement.php');
	
	class t_mode_reglement_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("t_mode_reglement LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("t_mode_reglement");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("t_mode_reglement");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("t_mode_reglement","id_mode_regl=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("t_mode_reglement","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE t_mode_reglement");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("t_mode_reglement","id_mode_regl=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($lib)
	{
	
	$values = array(array( 'lib'=>$lib ));
	HDB::hus()->Hinsert('t_mode_reglement', $values);
	}
	
	// UPDATE
	public function Update($lib,$id)
	{
	$sql = "  lib =:lib WHERE id_mode_regl = :id ";
	$data = array(':lib'=>$lib,':id'=>$id);
	HDB::hus()->Hupdate('t_mode_reglement',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	