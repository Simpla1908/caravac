
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        groupe_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		groupe
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_groupe.php');
	
	class groupe_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("groupe LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("groupe");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("groupe");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("groupe","id=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("groupe","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE groupe");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("groupe","id=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($libelle,$module_id,$user_id,$hotel_id)
	{
	
	$values = array(array( 'libelle'=>$libelle,'module_id'=>$module_id,'user_id'=>$user_id,'hotel_id'=>$hotel_id ));
	HDB::hus()->Hinsert('groupe', $values);
	}
	
	// UPDATE
	public function Update($libelle,$module_id,$user_id,$hotel_id,$id)
	{
	$sql = "  libelle =:libelle,module_id =:module_id,user_id =:user_id,hotel_id =:hotel_id WHERE id = :id ";
	$data = array(':libelle'=>$libelle,':module_id'=>$module_id,':user_id'=>$user_id,':hotel_id'=>$hotel_id,':id'=>$id);
	HDB::hus()->Hupdate('groupe',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	