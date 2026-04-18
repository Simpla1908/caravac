
	<?php
	/*
	* =======================================================================
	* CLASSNAME:        v_souscription_model
	* DATE CREATED:  	17-11-2017
	* FOR TABLE:  		users_groupes
	* PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
	* AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
	* =======================================================================
	*/
	if(!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
	
	include_once(APP_FOLDER.'/models/classes/class_users_groupes.php');
	
	class users_groupes_model{
	
	// SELECT ALL
	public function SelectAll($limit=NULL)
	{
	if($limit){
	$startpg = pageparam($limit);
	return HDB::hus()->Hselect("users_groupes LIMIT {$startpg} , {$limit}");
	}else{
	return HDB::hus()->Hselect("users_groupes");	
	}
	}
	
	//Select Count for Pagination
	public function CountRow()
	{
	return HDB::hus()->Hcount("users_groupes");
	}
	
	// SELECT ONE
	public function SelectOne($id)
	{
	$bind = array(":id" =>$id);
	return HDB::hus()->Hone("users_groupes","=:id",$bind);
	}
	
	// QUICK SEARCH
	public function AutoSearch($qstring,$limit,$where)
	{
	$bind = array(":svalue" =>"%$qstring%");
	return HDB::hus()->Hselect("users_groupes","$where LIKE :svalue LIMIT $limit",$bind);		
	}
	
	// TRUNCATE TABLE
	public function TruncateTable($redirect_to)
	{
   	$sql=HDB::hus()->prepare("TRUNCATE users_groupes");
	$sql->execute();
	send_to($redirect_to);
	}
	
	// DELETE
	public function Delete($id,$redirect_to)
	{
	$bind = array(":id" =>$id);
	HDB::hus()->Hdelete("users_groupes","=:id",$bind);
	send_to($redirect_to);
	}
	
	// INSERT
	public function Insert($user_id,$group_id,$affecteur_id,$dte)
	{
	
	$values = array(array( 'user_id'=>$user_id,'group_id'=>$group_id,'affecteur_id'=>$affecteur_id,'dte'=>$dte ));
	HDB::hus()->Hinsert('users_groupes', $values);
	}
	
	// UPDATE
	public function Update($user_id,$group_id,$affecteur_id,$dte,$id)
	{
	$sql = "  user_id =:user_id,group_id =:group_id,affecteur_id =:affecteur_id,dte =:dte WHERE  = :id ";
	$data = array(':user_id'=>$user_id,':group_id'=>$group_id,':affecteur_id'=>$affecteur_id,':dte'=>$dte,':id'=>$id);
	HDB::hus()->Hupdate('users_groupes',$sql,$data);
	
	}
	
	
	} // end class
	
	?>
	
	