
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        module_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		module
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_module.php');
	
	class module_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("module LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("module");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("module");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("module","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("module","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE module");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("module","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($nom,$code)
	{
	
	$values = array(array( 'nom'=>$nom,'code'=>$code ));
	HDB::hus()->Hinsert('module', $values);
	}
	
	// UPDATE
	public function Update($nom,$code,$id)
	{
	$sql = "  nom =:nom,code =:code WHERE id = :id ";
	$data = array(':nom'=>$nom,':code'=>$code,':id'=>$id);
	HDB::hus()->Hupdate('module',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	