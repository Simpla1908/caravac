
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        actions_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		actions
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_actions.php');
	
	class actions_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("actions LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("actions");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("actions");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("actions","id_act=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("actions","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE actions");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("actions","id_act=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($code_act,$lib_act,$visible,$module_id)
	{
	
	$values = array(array( 'code_act'=>$code_act,'lib_act'=>$lib_act,'visible'=>$visible,'module_id'=>$module_id ));
	HDB::hus()->Hinsert('actions', $values);
	}
	
	// UPDATE
	public function Update($code_act,$lib_act,$visible,$module_id,$id)
	{
	$sql = "  code_act =:code_act,lib_act =:lib_act,visible =:visible,module_id =:module_id WHERE id_act = :id ";
	$data = array(':code_act'=>$code_act,':lib_act'=>$lib_act,':visible'=>$visible,':module_id'=>$module_id,':id'=>$id);
	HDB::hus()->Hupdate('actions',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	