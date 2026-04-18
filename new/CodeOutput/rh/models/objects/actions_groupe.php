
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        actions_groupe_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		actions_groupe
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_actions_groupe.php');
	
	class actions_groupe_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("actions_groupe LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("actions_groupe");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("actions_groupe");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("actions_groupe","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("actions_groupe","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE actions_groupe");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("actions_groupe","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($group_id,$action_id)
	{
	
	$values = array(array( 'group_id'=>$group_id,'action_id'=>$action_id ));
	HDB::hus()->Hinsert('actions_groupe', $values);
	}
	
	// UPDATE
	public function Update($group_id,$action_id,$id)
	{
	$sql = "  group_id =:group_id,action_id =:action_id WHERE id = :id ";
	$data = array(':group_id'=>$group_id,':action_id'=>$action_id,':id'=>$id);
	HDB::hus()->Hupdate('actions_groupe',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	